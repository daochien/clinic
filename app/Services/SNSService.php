<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 2/1/19
 * Time: 3:56 PM.
 */

namespace App\Services;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SNSService
{
    private $client;

    public function __construct()
    {
        $this->client = App::make('aws')->createClient('sns');
    }

    public function getDeviceArn($data)
    {
        try {
            if (isset($data['platform']) && $data['platform'] == 'android') {
                $platformApplicationArn = env('ANDROID_APPLICATION_ARN');
            } elseif (isset($data['platform']) && $data['platform'] == 'ios') {
                $platformApplicationArn = env('IOS_APPLICATION_ARN');
            }

            $result = $this->client->createPlatformEndpoint([
                'PlatformApplicationArn' => $platformApplicationArn,
                'Token' => $data['device_token'],
            ]);

            return [
                'status' => true,
                'data' => [
                    'platform' => $data['platform'],
                    'device_token' => $data['device_token'],
                    'arn' => $result['EndpointArn'] ?? '',
                ]
            ];
        } catch (\Exception $ex) {
            return  [
                'status' => false,
                'data' => [
                    'message' => $ex->getMessage(),
                    'code' => $ex->getCode()
                ]
            ];
        }
    }

    public function publish($data)
    {
        try {
            $endpointAtt = $this->client->getEndpointAttributes([
                'EndpointArn' => $data['arn'],
            ]);
            if ($endpointAtt == 'failed' || !$endpointAtt['Attributes']['Enabled']) {
                return Log::error('not found endPointArn of device arn = ' . $data['arn']);
            }

            if ($data['platform'] == 'android') {
                $fcmPayload = json_encode(
                    [
                        'notification' =>
                            [
                                'title' => $data['title'],
                                "body" => strip_tags($data['content']),
                                'sound' => 'default'
                            ],
                        'data' => $data
                    ]
                );

                $message = json_encode([
                    'default' => $data['content'],
                    'GCM' => $fcmPayload
                ]);

                $result = $this->client->publish([
                    'TargetArn' => $data['arn'],
                    'Message' => $message,
                    'MessageStructure' => 'json'
                ]);
                Log::channel('notification')->info(json_encode($result));
                return $result;
            } else if ($data['platform'] == 'ios') {
                $payload = [
                    'aps' => [
                        'alert' => strip_tags($data['content']),
                        'badge' => 1,
                        'sound' => 'default'
                    ],
                    'order_id' => 'test',
                ];

                $message = json_encode([
                    'default' => strip_tags($data['content']),
                    'APNS' => json_encode($payload)
                ]);

                $result = $this->client->publish([
                    'TargetArn' => $data['arn'],
                    'Message' => $message,
                    'MessageStructure' => 'json'
                ]);

                Log::channel('notification')->info(json_encode($result));
                return $result;
            }
        } catch (\Exception $exception) {
            Log::channel('notification')->info("Publish Notification Error : {$exception->getMessage()}");
        }
    }
}
