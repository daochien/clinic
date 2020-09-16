<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Pages\PageEditRequest;
use App\Http\Requests\Pages\PageRequest;
use App\Http\Resources\ManualCollection;
use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use App\Services\PageServices;
use App\Services\S3Service;
use App\Http\Resources\PageCollection;
use App\Models\Page;

class PageController extends BaseController
{

    protected $page;
    protected $pageRepo;
    protected $pageService;
    protected $s3Service;

    public function __construct(Page $page, PageRepository $pageRepo, PageServices $pageService, S3Service $s3Service)
    {
        $this->page = $page;
        $this->pageRepo = $pageRepo;
        $this->pageService = $pageService;
        $this->s3Service = $s3Service;
    }

    public function index(Request $request)
    {
        try {
            $pages = $this->pageRepo->getAll($request->all());            
            return new PageCollection($pages);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }        
    }

    public function store(PageRequest $request)
    {
        try {
            $page = $this->pageService->createPage($request->all());            
            return $this->sendSuccessResponse($page, 'Page Created Successfully');
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function uploadImageContent(Request $request)
    {
        $pathFile = $this->s3Service->store($request->image, 'pages/images');
        return $this->sendSuccessResponse($pathFile, 'Image Created Successfully');
    }

    public function show($id)
    {
        try {
            $page = $this->pageRepo->show($id);            
            return $this->sendSuccessResponse($page, 'Page Details');
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
        
    }

    public function update(PageEditRequest $request, $id)
    {
        try {
            $page = $this->pageService->updatePage($id, $request);
            return $this->sendSuccessResponse($page, 'Page update Successfully');
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function destroy($id)
    {

        $page = $this->page->findOrFail($id);

        $page->delete();

        return $this->sendSuccessResponse($page, 'Page has been Deleted');
    }

    public function changeStatus($id)
    {
        try {
            $page = $this->pageRepo->changeStatus($id);
            return $this->sendSuccessResponse($page, 'Page Created Successfully');
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }

    }

    public function rating(Request $request, $id)
    {
        try {
            $result = $this->pageService->rating($id, $request->only('type'));
            return $this->sendSuccessResponse($result, 'Update rating Successfully');
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage()); 
        }
    }
    
    public function manualLatest()
    {
        try {
            $manuals = $this->pageRepo->latestManual();            
            return new ManualCollection($manuals);            
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
        
    }
    
}
