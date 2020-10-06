<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\S3Service;
use App\Services\PageServices;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;

class PageController extends Controller
{

    protected $s3Service;
    protected $pageService;
    protected $page;

    public function __construct(S3Service $s3Service, PageServices $pageService, Page $page)
    {
        $this->s3Service = $s3Service;
        $this->pageService = $pageService;
        $this->page = $page;
    }

    public function index()
    {
        return view('client.page');
    }

    public function downloadUrl(Request $request)
    {
        try {
            if (empty($request->page_id)) {
                throw new \Exception('Could not open stream for reading file');
            }

            $page = $this->page->findOrFail($request->page_id);
            
            $files = !empty($page->files) ? json_decode($page->files) : [];

            if (empty($files)) {
                throw new \Exception('Could not open stream for reading file');
            }

            $strReplace = 'https://s3.us-east-2.amazonaws.com/'.config('filesystems.disks.s3.bucket');
            $newPath = str_replace($strReplace.'/','',$files->path);
    
            $adapter = Storage::disk('s3')->getAdapter();
            $client = $adapter->getClient();
            $client->registerStreamWrapper();
            $object = $client->headObject([
                'Bucket' => $adapter->getBucket(),
                'Key' => $newPath,
            ]);
            /*************************************************************************
             * Set headers to allow browser to force a download
             */
            header('Last-Modified: '.$object['LastModified']);
            // header('Etag: '.$object['ETag']); # We are not implementing validation caching here, but we could!
            header('Accept-Ranges: '.$object['AcceptRanges']);
            header('Content-Length: '.$object['ContentLength']);
            header('Content-Type: '.$object['ContentType']);
            header('Content-Disposition: attachment; filename='.$files->name);
            /*************************************************************************
             * Stream file to the browser
             */
            // Open a stream in read-only mode
            if (!($stream = fopen("s3://{$adapter->getBucket()}/{$newPath}", 'r'))) {
                throw new \Exception('Could not open stream for reading file: ['.$newPath.']');
            }
            // Check if the stream has more data to read
            while (!feof($stream)) {
                // Read 1024 bytes from the stream
                echo fread($stream, 1024);
            }
            // Be sure to close the stream resource when you're done with it
            fclose($stream);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json('Could not open stream for reading file');
        }
                
    }
}
