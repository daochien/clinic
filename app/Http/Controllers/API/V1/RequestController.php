<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use App\Models\RequestComment;
use App\Models\RequestLog;
use App\Models\Submission;
use App\Services\RequestLogService;
use App\Services\RequestService;
use Illuminate\Http\Request;
use App\Models\Form;

class RequestController extends BaseController
{

    protected $template = '';
    /**
     * @var RequestService
     */
    private $requestService;
    /**
     * @var RequestLogService
     */
    private $requestLogService;

    /**
     * Create a new controller instance.
     *
     * @param Form $template
     */
    public function __construct(Form $template, RequestService $requestService, RequestLogService $requestLogService)
    {
        $this->template = $template;
        $this->requestService = $requestService;
        $this->requestLogService = $requestLogService;
    }

    public function indexByCategory($categoryId)
    {
        return $this->sendResponse($this->requestService->getRequestByCategory($categoryId));
    }

    public function show($id)
    {
        $submission = $this->requestService->getRequest($id);
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
            $this->requestLogService->createLog($id, $user->id, $status);

            return $this->sendResponse(__('app.popup.update_success'));
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function comment(Request $request, $id)
    {
        try {
            $message = $request->get('message');
            $this->requestService->createRequestComment($id, $message);
            $allComment = RequestComment::where(['request_id' => $id])->with('user')->get();

            return $this->sendResponse($allComment);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }


}
