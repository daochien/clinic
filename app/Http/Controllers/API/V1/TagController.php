<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    protected $tag = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->latest()->paginate(config('app.item_per_request'));

        return $this->sendSuccessResponse($tags, 'Tags list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tags = $this->tag->get(['name', 'id']);

        return $this->sendSuccessResponse($tags, 'Tags list');
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
    public function store(Request $request)
    {
        $tag = $this->tag->create([
            'name' => $request->get('name')
        ]);

        return $this->sendSuccessResponse($tag, 'Tag Created Successfully');
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
        $tag = $this->tag->findOrFail($id);

        $tag->update($request->all());

        return $this->sendSuccessResponse($tag, 'Tag Information has been updated');
    }
}
