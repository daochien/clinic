<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\Form;

class TemplateController extends BaseController
{

    protected $template = '';


    /**
     * Create a new controller instance.
     *
     * @param Form $template
     */
    public function __construct(Form $template)
    {
        $this->template = $template;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Form::paginate();

        return $this->sendResponse($templates, 'Templates list');
    }

    public function show(Request $request, $id)
    {
        $form = $this->template->where(['id' => $id])
            ->with(['user','category','approvers'])
            ->withCount('submissions')
            ->firstOrFail();

        return $this->sendResponse($form, 'Templates list');
    }
}
