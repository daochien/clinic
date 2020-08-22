<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use App\Events\Form\FormCreated;
use App\Events\Form\FormDeleted;
use App\Events\Form\FormUpdated;
use App\Helper\FormBuilderHelper;
use App\Models\Form;
use App\Http\Requests\SaveFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $breadCrumbTitle = __('template.create_breadcrumb_label');

        $saveURL = route('template.store');
        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = FormBuilderHelper::getConfiguredRoles();

        return view('template.forms.create', compact('pageTitle', 'breadCrumbTitle', 'saveURL', 'form_roles'));
    }

    public function store(SaveFormRequest $request)
    {
        $user = $request->user();

        $input = $request->merge(['user_id' => $user->id])->except('_token');

        DB::beginTransaction();

        // generate a random identifier
        $input['identifier'] = $user->id.'-'.FormBuilderHelper::randomString(20);
        $created = Form::create($input);

        try {
            // dispatch the event
            event(new FormCreated($created));

            DB::commit();

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully created!',
                        'dest' => route('template.index'),
                    ]);
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return response()->json(['success' => false, 'details' => 'Failed to create the form.']);
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

        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $pageTitle = 'Edit Form';

        $saveURL = route('template.update', $form);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = FormBuilderHelper::getConfiguredRoles();

        return view('template.forms.edit', compact('form', 'pageTitle', 'saveURL', 'form_roles'));
    }

    public function update(SaveFormRequest $request, $id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $input = $request->except('_token');

        if ($form->update($input)) {
            // dispatch the event
            event(new FormUpdated($form));

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully updated!',
                        'dest' => route('template.index'),
                    ]);
        } else {
            response()->json(['success' => false, 'details' => 'Failed to update the form.']);
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $form->delete();

        // dispatch the event
        event(new FormDeleted($form));

        return back()->with('success', "'{$form->name}' deleted.");
    }
}
