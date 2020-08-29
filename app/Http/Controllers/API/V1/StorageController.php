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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    private $s3Service;

    public function __construct(S3Service $s3Service)
    {
        $this->s3Service = $s3Service;
    }

    public function store(Request $request)
    {
        try {
            $file = $request->file('image');
            $path = "images";
            return response()->json(['image_url' => $this->s3Service->store($file, $path)]);
        } catch (\Exception $ex) {
            report($ex);
            return response()->json([
                'errors' => ['code' => 31, 'message' => __('errors.031')],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
