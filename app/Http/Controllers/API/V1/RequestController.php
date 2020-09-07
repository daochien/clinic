<?php

namespace App\Http\Controllers\API\V1;

use App\Helper\FormBuilderHelper as Helper;
use App\Models\RequestComment;
use App\Models\RequestLog;
use App\Models\Submission;
use App\Services\RequestLogService;
use App\Services\RequestService;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        return $this->sendSuccessResponse($this->requestService->getRequestByCategory($categoryId));
    }

    public function show($id)
    {
        $submission = $this->requestService->getRequest($id);
        $form_headers = $submission->form->getEntriesHeader();

        return $this->sendSuccessResponse(['submission' => $submission, 'form_headers' => $form_headers]);
    }

    public function downloadAttachment(Request $request, $fileName)
    {
        return Storage::download("attachment/{$fileName}");
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $status = $request->get('status');
            if (!in_array($status, array_values(RequestLog::STATUS))) {
                return $this->sendErrorResponse(__('app.template.request.error.invalid_status'));
            }
            $user = auth()->user();
            $this->requestLogService->createLog($id, $user->id, $status);

            return $this->sendSuccessResponse(__('app.popup.update_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function comment(Request $request, $id)
    {
        try {
            $this->requestService->createRequestComment($id, $request);
            $allComment = RequestComment::where(['request_id' => $id])->with('user', 'attachments')->get();

            return $this->sendSuccessResponse($allComment);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function store(Request $request, $identifier)
    {
        try {
            $submission = $this->requestService->createRequest($request, $identifier);

            return $this->sendResponse($submission);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }
}
