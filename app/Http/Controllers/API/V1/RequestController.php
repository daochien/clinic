<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\Form;

class RequestController extends BaseController
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

    public function indexByCategory($categoryId)
    {
        $requests = Submission::from('form_submissions as s')
            ->join('template_category as tc', 'tc.form_id', 's.form_id')
            ->where('tc.category_id', $categoryId)
            ->with(['requestLogs', 'requestComments', 'approvers', 'user'])
            ->latest()
            ->paginate(10);

        return $this->sendResponse($requests);
    }

    public function show($id)
    {
        $submission = Submission::with('user', 'form', 'form.approvers','form.category')
            ->where('id', $id)
            ->firstOrFail();

        $form_headers = $submission->form->getEntriesHeader();

        return $this->sendResponse(['submission' => $submission, 'form_headers' => $form_headers]);
    }
}
