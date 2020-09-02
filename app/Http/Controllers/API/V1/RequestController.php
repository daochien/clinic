<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use App\Models\RequestLog;
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
            ->with(['requestLogs', 'requestComments', 'user', 'form.approvers'])
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

    public function changeStatus(Request $request, $id)
    {
        try {
            $status = $request->get('status');
            if (!in_array($status, array_values(RequestLog::STATUS))) {
                return $this->sendError(__('app.template.request.error.invalid_status'));
            }

            $user = auth()->user();
            RequestLog::create([
                'request_id' => $id,
                'approver_id' => $user->id,
                'status' => $status
            ]);

            return $this->sendResponse(__('app.popup.update_success'));
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }
}
