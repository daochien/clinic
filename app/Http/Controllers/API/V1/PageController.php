<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\DB;

class PageController extends BaseController
{

    protected $pageRepo;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepo = $pageRepo;
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $page = $this->pageRepo->create($request->all());

            if (!empty($request->image)) {
                $pathUploadImage = $this->pageRepo->getPathUpload($page);
                $image = $this->pageRepo->uploadFile($request->image, $pathUploadImage);
                if ($image) {
                    $page->image = $image;
                }
            }

            if (!empty($request->files)) {
                $pathUploadFile = $this->pageRepo->getPathUpload($page, 'files');
                $files = $this->pageRepo->uploadFiles($request->only('files'), $pathUploadFile);
                if ($files) {
                    $page->files = json_encode($files);
                }
            }

            $page->save();

            DB::commit();

            return $this->sendResponse($page, 'Page Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    public function uploadImageContent(Request $request)
    {
        $pathUpload = 'page/content/'.time();
        $image = $this->pageRepo->uploadFile($request->image, $pathUpload);
        return $this->sendResponse($image, 'Image Created Successfully');
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
