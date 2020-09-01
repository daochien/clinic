<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\DB;
use App\Services\PageServices;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\FAQCollection;
use App\Http\Resources\ManualCollection;

class PageController extends BaseController
{

    protected $pageRepo;
    protected $pageService;

    public function __construct(PageRepository $pageRepo, PageServices $pageService)
    {
        $this->pageRepo = $pageRepo;
        $this->pageService = $pageService;
    }

    public function index()
    {

    }

    public function store(Request $request)
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

    public function blogs()
    {
        $blogs = $this->pageRepo->getAll('blog', 4);
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
