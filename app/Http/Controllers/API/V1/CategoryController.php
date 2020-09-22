<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $category = '';
    protected $repository = '';

    /**
     * Create a new controller instance.
     *
     * @param Category $category
     * @param CategoryRepository $repository
     */
    public function __construct(Category $category, CategoryRepository $repository)
    {
        $this->category = $category;
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->latest()->paginate(10);

        return $this->sendSuccessResponse($categories, 'Category list');
    }

    public function getByType(Request $request, $type)
    {    
        if (!empty($request->show_client)) {
            $categories = $this->repository->showClientCategoryBlog(Category::TYPE[$type], $request->with_id, $request->latest_page);
        } else {
            $categories = $this->repository->getTemplateByCategory(Category::TYPE[$type]);
        }
                
        return $this->sendSuccessResponse($categories, 'Category list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = $this->category->pluck('name', 'id');

        return $this->sendSuccessResponse($categories, 'Category list');
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CategoryRequest $request)
    {
        $tag = $this->category->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'type' => Category::TYPE[$request->get('type')]
        ]);

        return $this->sendSuccessResponse($tag, 'Category Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $tag = $this->category->findOrFail($id);

        $tag->update($request->all());

        return $this->sendSuccessResponse($tag, 'Category Information has been updated');
    }
}
