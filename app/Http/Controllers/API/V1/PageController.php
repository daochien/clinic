<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Pages\PageRequest;
use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\DB;
use App\Services\PageServices;
use App\Services\S3Service;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\FAQCollection;
use App\Http\Resources\ManualCollection;
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
        $pages = $this->pageRepo->getAll($request->all());        
        return new PageCollection($pages);
    }

    public function updateData(Request $request)
    {
        dd($request->all());
    }

    public function store(PageRequest $request)
    {
        try {                        
            $page = $this->pageService->createPage($request->all());
            return $this->sendResponse($page, 'Page Created Successfully');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function uploadImageContent(Request $request)
    {        
        $pathFile = $this->s3Service->store($request->image, 'pages/images');
        return $this->sendResponse($pathFile, 'Image Created Successfully');
    }

    public function show($id)
    {
        $page = $this->page->find($id);
       
        return $this->sendResponse($page, 'Page Details');
    }

    public function update(Request $request, $id)
    {
        try {            
            dd($request->all());
            $page = $this->pageService->updatePage($id, $request->all());
            return $this->sendResponse($page, 'Page update Successfully');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        } 
    }

    public function destroy($id)
    {
        
        $page = $this->page->findOrFail($id);        

        $page->delete();

        return $this->sendResponse($page, 'Page has been Deleted');
    }

    public function changeStatus($id)
    {
        try {
            $page = $this->pageRepo->changeStatus($id);
            return $this->sendResponse($page, 'Page Created Successfully');
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        
    }

    public function blogs()
    {
        $blogs = $this->pageRepo->getAll(['type' => 'blog'], 4);
        return new BlogCollection($blogs);
    }

    public function blogLatest()
    {
        $blogsLatest = $this->pageRepo->latestPage('blog', 5);
        return new BlogCollection($blogsLatest);
    }

    public function manualLatest()
    {
        $manuals = $this->pageRepo->latestPage('manual', 8);
        return new ManualCollection($manuals);
    }

    public function faqLatest()
    {
        $faqs = $this->pageRepo->latestPage('faq', 4);
        return new FAQCollection($faqs);
    }
}
