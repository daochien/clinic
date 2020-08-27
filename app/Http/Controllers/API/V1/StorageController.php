<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: atb-member
 * Date: 2/1/19
 * Time: 1:06 PM.
 */

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\S3Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StorageController extends Controller
{
    private $s3Service;

    public function __construct(S3Service $s3Service)
    {
        $this->s3Service = $s3Service;
    }

    public function upload(Request $request)
    {
        $file = $request->file('image')->store("images", 's3');
        return response()->json($file);
    }

    public function createS3UploadUrl(Request $request)
    {
        try {
            $inputPath = $request->get('path');
            $fileName  = $request->get('file_name');

            if (empty($inputPath) &&  $fileName) {
                $uuid      = $this->uniqueId(32, now()->format('YmdH'));
                $inputPath = "images/{$uuid}";
            } elseif (!empty($inputPath)) {
                // Normalize the input path
                $inputPath = preg_replace('/\/{2,}/', '/', $inputPath);
                $inputPath = $inputPath[0] === '/' ? substr($inputPath, 1) : $inputPath;
            }

            if (empty($inputPath) || !preg_match('/^[a-z0-9-_.\/]+$/i', $inputPath)) {
                return response()->json([
                    'errors' => ['code' => 11, 'message' => __('errors.011')],
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json($this->s3Service->createUploadUrl($inputPath, now()->addMinutes(30)));
        } catch (\Exception $ex) {
            report($ex);
            return response()->json([
                'errors' => ['code' => 31, 'message' => __('errors.031')],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function uniqueId($length = 16, $prefix = '')
    {
        if (!is_numeric($length) || $length <= 0) {
            $length = 16;
        }

        if (function_exists('random_bytes')) {
            $raw    = random_bytes((int) ceil($length / 2));
            $result = substr(bin2hex($raw), 0, (int) $length);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $raw    = openssl_random_pseudo_bytes((int) ceil($length / 2));
            $result = substr(bin2hex($raw), 0, (int) $length);
        } else {
            $result = substr(str_replace('-', '', \Ramsey\Uuid\Uuid::uuid4()), 0, (int) $length);
        }
        return "${prefix}${result}";
    }
}
