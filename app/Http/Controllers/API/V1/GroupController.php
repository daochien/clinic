<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Groups\GroupRequest;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

class GroupController extends BaseController
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
        $data = Group::latest()->paginate(10);
        return $this->sendResponse($data, 'Groups list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Groups\GroupRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(GroupRequest $request)
    {
        $entity = Group::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $this->sendResponse($entity, 'Group Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Groups\GroupRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(GroupRequest $request, $id)
    {
        $entity = Group::findOrFail($id);
        $entity->update($request->all());

        return $this->sendResponse($entity, 'Group information has been updated');
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

        $entity = Group::findOrFail($id);
        // delete the entity

        $entity->delete();

        return $this->sendResponse([$entity], 'Group has been Deleted');
    }

    public function members($id)
    {
        $entity = GroupUser::where('group_id', $id)->first();
        if (isset($entity->group_id)) {
            $data = $entity->users()->paginate(10);
            return $this->sendResponse($data, 'Members list');
        }
        return response()->json(['data' => ['data' => []]]);
    }
}
