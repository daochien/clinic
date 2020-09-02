<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use App\Events\Form\FormCreated;
use App\Events\Form\FormDeleted;
use App\Events\Form\FormUpdated;
use App\Helper\FormBuilderHelper;
use App\Models\Category;
use App\Models\Form;
use App\Http\Requests\SaveFormRequest;
use App\Models\Role;
use App\Models\TemplateApprover;
use App\Models\TemplateCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class FormController extends Controller
{
    public $categoryRepository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;


    public function __construct(CategoryRepository $categoryRepository, PermissionRepository $permissionRepository)
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $pageTitle = "Forms";

        $forms = Form::getForUser(auth()->user());

        return view('template.forms.index', compact('pageTitle', 'forms'));
    }

    public function create()
    {
        $pageTitle = "Create New Form";
        $breadCrumbTitle = __('request.template.info._page_title_create');
        $category = $this->categoryRepository->getTemplateByCategory(Category::TYPE['template']);

        $saveURL = route('template.store');
        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = FormBuilderHelper::getConfiguredRoles();

        $adminList = $this->permissionRepository->getUserByPermission('template');

        return view('template.forms.create', compact('category', 'adminList', 'pageTitle', 'breadCrumbTitle', 'saveURL', 'form_roles'));
    }

    public function store(SaveFormRequest $request)
    {
        $user = $request->user();
        $input = $request->merge(['user_id' => $user->id])->except(['_token', 'approver', 'category']);

        try {
            DB::beginTransaction();

            // generate a random identifier
            $input['identifier'] = $user->id.'-'.FormBuilderHelper::randomString(20);
            $created = Form::create($input);
            $approvers = $request->get('approver');
            $templateApprover = [];
            foreach ($approvers as $approver) {
                $templateApprover[] = [
                    'form_id' => $created->id,
                    'user_id' => $approver,
                ];
            }
            TemplateApprover::insertOrIgnore($templateApprover);
            TemplateCategory::insertOrIgnore([
                'form_id' => $created->id,
                'category_id' => $request->get('category'),
            ]);

            // dispatch the event
            event(new FormCreated($created));

            DB::commit();

            return response()
                    ->json([
                        'success' => true,
                        'details' => __('request.template.info.messages._create_success'),
                        'dest' => config('app.url') . "/admin/template",
                    ]);
        } catch (Throwable $e) {
            info($e);
            DB::rollback();

            return response()->json(['success' => false, 'details' => __('common.messages._system_err')]);
        }
    }

    public function show($id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])
                    ->with('user')
                    ->withCount('submissions')
                    ->firstOrFail();

        $pageTitle = "Preview Form";

        return view('template.forms.show', compact('pageTitle', 'form'));
    }

    public function edit($id)
    {
        $user = auth()->user();

        $form = Form::where(['user_id' => $user->id, 'id' => $id])->with(['approvers', 'category'])->firstOrFail();

        $pageTitle = "Preview Form";
        $breadCrumbTitle = __('request.template.info._page_title_edit');
        $category = $this->categoryRepository->getTemplateByCategory(Category::TYPE['template']);
        $adminList = $this->permissionRepository->getUserByPermission('template');

        $saveURL = route('template.update', $form);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = FormBuilderHelper::getConfiguredRoles();

        return view('template.forms.edit', compact('form', 'category', 'adminList', 'pageTitle', 'breadCrumbTitle', 'saveURL', 'form_roles'));
    }

    public function update(SaveFormRequest $request, $id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->with(['approvers', 'category'])->firstOrFail();

        $input = $request->except(['_token', 'approver', 'category']);
        try {
            DB::beginTransaction();

            $approvers = $request->get('approver');
            $templateApprover = [];
            foreach ($approvers as $approver) {
                $templateApprover[] = [
                    'form_id' => $form->id,
                    'user_id' => $approver,
                ];
            }
            TemplateApprover::where('form_id', $form->id)->delete();
            TemplateApprover::insertOrIgnore($templateApprover);
            TemplateCategory::where('form_id', $form->id)->delete();
            TemplateCategory::insertOrIgnore([
                'form_id' => $form->id,
                'category_id' => $request->get('category'),
            ]);

            if ($form->update($input)) {
                DB::commit();
                // dispatch the event
                event(new FormUpdated($form));
                return response()
                        ->json([
                            'success' => true,
                            'details' => __('request.template.info.messages._edit_success'),
                            'dest' => config('app.url') . "/admin/template",
                        ]);
            } else {
                response()->json(['success' => false, 'details' => __('request.template.info.messages._edit_failed')]);
            }
        } catch (Throwable $e) {
            info($e);
            DB::rollback();

            return response()->json(['success' => false, 'details' => __('common.messages._system_err')]);
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        TemplateApprover::where('form_id', $form->id)->delete();
        TemplateCategory::where('form_id', $form->id)->delete();
        $form->delete();

        // dispatch the event
        event(new FormDeleted($form));

        return back()->with('success', "'{$form->name}' deleted.");
    }
}
