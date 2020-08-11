<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    protected $group = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = $this->group->latest()->withCount('group_users')->paginate(10);
        return $this->sendResponse($group, 'Group list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $group = $this->group->pluck('name', 'id');

        return $this->sendResponse($group, 'Group list');
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $tag = $this->group->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
        ]);

        return $this->sendResponse($tag, 'Group Created Successfully');
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $tag = $this->group->findOrFail($id);

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Group Information has been updated');
    }

    public function find($id)
    {
        // get a groups by id
        $group  = $this->group->where('id', $id)->get();
        return $this->sendResponse($group, 'Group information');
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
}
