<?php

namespace App\Http\Controllers\API\V1;

use App\Helper\FormBuilderHelper as Helper;
use App\Http\Requests\InquiryRequest;
use App\Http\Resources\InquiryCollection;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use App\Models\InquiryComment;
use App\Models\InquiryLog;
use App\Models\RequestComment;
use App\Models\RequestLog;
use App\Models\Submission;
use App\Services\InquiryService;
use App\Services\RequestLogService;
use App\Services\RequestService;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InquiryController extends BaseController
{

    protected $template = '';
    /**
     * @var RequestService
     */
    private $requestService;
    /**
     * @var InquiryService
     */
    private $inquiryService;


    public function __construct(InquiryService $inquiryService)
    {
        $this->inquiryService = $inquiryService;
    }

    public function indexByCategory($categoryId)
    {
        return new InquiryCollection($this->inquiryService->getRequestByCategory($categoryId));
    }

    public function index(Request $request)
    {
        return new InquiryCollection($this->inquiryService->getAll($request->all()));
    }

    public function show($id)
    {
        $inquiry = $this->inquiryService->getDetail($id);

        return $this->sendSuccessResponse(new InquiryResource($inquiry));
    }

    public function downloadAttachment(Request $request, $fileName)
    {
        return Storage::download("attachment/{$fileName}");
    }

    public function search(Request $request)
    {
        try {
            $data = $this->inquiryService->search($request);
            return new InquiryCollection($data);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $status = $request->get('status');
            if ($status != Inquiry::STATUS['close']) {
                return $this->sendErrorResponse(__('inquiry.list.messages._close_failed'));
            }

            $user = auth()->user();
            $this->inquiryService->closeInquiry($user, $id);

            return $this->sendSuccessResponse(__('inquiry.list.messages._close_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function comment(Request $request, $id)
    {
        try {
            $this->inquiryService->comment($id, $request);
            $allComment = InquiryComment::where(['inquiry_id' => $id])
                ->with('user', 'attachments')
                ->get();

            return $this->sendSuccessResponse($allComment);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }

    public function store(InquiryRequest $request)
    {
        try {
            $inquiry = $this->inquiryService->storage($request->validated());

            return $this->sendSuccessResponse($inquiry);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getMessage());
        }
    }
}
