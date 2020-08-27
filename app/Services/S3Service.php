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

class S3Service
{
    /**
     * @var \League\Flysystem\AwsS3v3\AwsS3Adapter
     */
    private $s3Adapter;

    public function __construct(FilesystemManager $filesystemManager)
    {
        $this->s3Adapter = $filesystemManager->drive('s3')->getDriver()->getAdapter();
    }

    /**
     * Generates S3 upload url.
     * @param string $path The path (Object Key) in the S3 bucket
     * @param $expiration
     * @param array $options
     * @return array
     */
    public function createUploadUrl(string $path, $expiration, array $options = [])
    {
        $options += ['ACL' => 'public-read'];
        $s3Client    = $this->s3Adapter->getClient();
        $commandArgs = [
            'Bucket' => $this->s3Adapter->getBucket(),
            'Key'    => $this->s3Adapter->getPathPrefix() . $path,
        ] + $options;

        $command  = $s3Client->getCommand('PutObject', $commandArgs);

        return [
            'object_key' => $commandArgs['Key'],
            'existed'    => $this->doesObjectExist($commandArgs['Key'], $options),
            'upload_url' => (string) $s3Client->createPresignedRequest($command, $expiration)->getUri(),
            'access_url' => $this->getAccessUrl($path),
        ];
    }

    /**
     * Get S3 object access url.
     * @param $path string The path (Object Key) in the S3 bucket
     * @return string the access url of S3 object
     */
    public function getAccessUrl(string $path)
    {
        $bucketUrl  = env('AWS_BUCKET_URL');
        $s3Client   = $this->s3Adapter->getClient();
        $bucketName = $this->s3Adapter->getBucket();
        $objectKey  = $this->s3Adapter->getPathPrefix() . $path;

        if ($bucketUrl) {
            return substr($bucketUrl, -1) === '/' ? "${bucketUrl}${objectKey}" : "${bucketUrl}/${objectKey}";
        }

        // Standard default url
        // Refer: https://docs.aws.amazon.com/AmazonS3/latest/dev/UsingBucket.html
        $region = $s3Client->getRegion();
        return "https://s3.${region}.amazonaws.com/${bucketName}/${objectKey}";
    }

    /**
     * Determines whether the specified S3 object exists.
     * @param $path string The path (Object Key) in the S3 bucket
     * @param array $options
     * @return true if exists, else return false
     */
    public function doesObjectExist(string $path, array $options = [])
    {
        $s3Client   = $this->s3Adapter->getClient();
        $bucketName = $this->s3Adapter->getBucket();
        $objectKey  = $this->s3Adapter->getPathPrefix() . $path;
        return $s3Client->doesObjectExist($bucketName, $objectKey, $options);
    }

    /**
     * Delete the original object.
     * @param $path string The path (Object Key) in the S3 bucket
     * @param array $options
     * @return true if deleted
     */
    public function deleteObject(string $path, array $options = [])
    {
        $s3Client = $this->s3Adapter->getClient();
        $s3Client->deleteObject([
            'Bucket' => $this->s3Adapter->getBucket(),
            'Key'    => $this->s3Adapter->getPathPrefix() . $path,
        ] + $options);
        return true;
    }

    /**
     * Copy the original object.
     * @param $path string The path (Object Key) in the S3 bucket
     * @param string $newPath
     * @param array  $options
     * @return array new object if copied, else null
     */
    public function copyObject(string $path, string $newPath, array $options = [])
    {
        $options += ['ACL' => 'public-read'];
        $s3Client   = $this->s3Adapter->getClient();
        $bucketName = $this->s3Adapter->getBucket();
        $objectKey  = $this->s3Adapter->getPathPrefix() . $path;
        $newObjKey  = "{$this->s3Adapter->getPathPrefix()}{$newPath}";

        if ($this->doesObjectExist($objectKey, $options)) {
            $s3Client->copyObject([
                'Bucket'     => $bucketName,
                'Key'        => $newObjKey,
                'CopySource' => "{$bucketName}/{$objectKey}",
            ] + $options);
        }

        return [
            'object_key' => $newObjKey,
            'existed'    => $this->doesObjectExist($newObjKey, $options),
            'access_url' => $this->getAccessUrl($newPath),
        ];
    }
}
