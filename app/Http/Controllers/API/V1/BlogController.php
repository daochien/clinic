<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Blogs\BlogRequest;
use App\Repositories\BlogRepository;
use App\Models\Blog;

class BlogController extends BaseController
{
    protected $blog;
    protected $blogRepo;

    public function __construct(Blog $blog, BlogRepository $blogRepo)
    {
        $this->blog = $blog;
        $this->blogRepo = $blogRepo;
    }

    public function store(BlogRequest $request)
    {
        $post = $this->blogRepo->create($request->validated());
        if (!$post) {
            return $this->sendError('Server error!');
        }
        return $this->sendResponse($post, 'create blog success');
    }

}
