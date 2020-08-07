<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Notifications\NotificationRequest;
use App\Models\Notification;

class NotificationController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Notification::latest()->paginate(10);
        return $this->sendResponse($data, 'Notifications list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Notifications\NotificationRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(NotificationRequest $request)
    {
        $entity = Notification::create([
            'title' => $request['title'],
            'content' => $request['content'],
            'confirm' => $request['confirm'],
            'draft' => $request['draft'],
        ]);

        return $this->sendResponse($entity, 'Notification Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Notifications\NotificationRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(NotificationRequest $request, $id)
    {
        $entity = Notification::findOrFail($id);
        $entity->update($request->all());

        return $this->sendResponse($entity, 'Notification information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $entity = Notification::findOrFail($id);
        // delete the entity

        $entity->delete();

        return $this->sendResponse([$entity], 'Notification has been Deleted');
    }
}
