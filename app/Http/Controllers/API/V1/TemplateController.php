<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Products\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Models\Form;

class TemplateController extends BaseController
{

    protected $product = '';

    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param Product $product
     * @param ProductRepository $productRepository
     */
    public function __construct(Product $product, ProductRepository $productRepository)
    {
        $this->product = $product;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Form::getForUser(auth()->user());

        return $this->sendResponse(compact('templates'), 'Templates list');
    }
}
