<?php

namespace App\Http\Controllers\API\V1;

use App\Events\Form\FormDeleted;
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
        $templates = Form::with(['approvers', 'category'])->paginate(10);

        return $this->sendResponse($templates, 'Templates list');
    }

    public function show(Request $request, $id)
    {
        $form = $this->template->where(['id' => $id])
            ->with(['user','category','approvers'])
            ->where('visibility', Form::FORM_PUBLIC)
            ->withCount('submissions')
            ->first();

        return $this->sendResponse($form, 'Templates list');
    }

    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();

        // dispatch the event
        event(new FormDeleted($form));

        return $this->sendResponse([$form]);
    }
}
