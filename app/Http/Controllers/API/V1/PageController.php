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
            $pathUpload = $this->pageRepo->getPathUpload($page);
            $image = $this->pageRepo->uploadFile($request->image, $pathUpload);
            if ($image) {
                $page->image = $image;
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
