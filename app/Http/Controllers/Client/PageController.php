<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\S3Service;
use App\Services\PageServices;
class PageController extends Controller
{

    protected $s3Service;
    protected $pageService;

    public function __construct(S3Service $s3Service, PageServices $pageService)
    {
        $this->s3Service = $s3Service;
        $this->pageService = $pageService;
    }

    public function index()
    {
        return view('client.page');
    }

    public function downloadUrl(Request $request)
    {
        try {
            return $this->pageService->downloadPath($request->path);
        } catch (\Exception $e) {
            return response()->json([
                'file not found'
            ]);
        }
    }
}
