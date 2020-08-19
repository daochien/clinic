<?php

namespace App\Http\Controllers\Admin\Template;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class MySubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // only allow submission edit on forms that allow it
        $this->middleware('submisson-editable')->only(['edit', 'update']);
    }

    public function index()
    {
        $user = auth()->user();

        $submissions = Submission::getForUser($user);

        $pageTitle = "My Submissions";

        return view('template.my-request.index', compact('submissions', 'pageTitle'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])
                            ->with('form')
                            ->firstOrFail();

        $form_headers = $submission->form->getEntriesHeader();

        $pageTitle = "View Submission";

        return view('template.my-request.show', compact('submission', 'pageTitle', 'form_headers'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])
                            ->with('form')
                            ->firstOrFail();

        // load up my current submissions into the form json data so that the
        // form is pre-filled with the previous submission we are trying to edit.
        $submission->loadSubmissionIntoFormJson();

        $pageTitle = "Edit My Submission for '{$submission->form->name}'";

        return view('template.my-request.edit', compact('submission', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        DB::beginTransaction();

        try {
            $input = $request->except(['_token', '_method']);

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            foreach ($uploadedFiles as $key => $file) {
                // store the file and set it's path to the value of the key holding it
                if ($file->isValid()) {
                    $input[$key] = $file->store('fb_uploads', 'public');
                }
            }

            $submission->update(['content' => $input]);

            DB::commit();

            return redirect()
                        ->route('template.my-request.index')
                        ->with('success', 'Submission updated.');
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return back()->withInput()->with('error', Helper::wtf());
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $submission->delete();

        return redirect()
                    ->route('template.my-request.index')
                    ->with('success', 'Submission deleted!');
    }
}
