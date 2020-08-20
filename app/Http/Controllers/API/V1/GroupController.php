<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupUser;
use DB;

use App\Http\Requests\Groups\GroupRequest;
use App\Models\User;


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
        $group = $this->group->findOrFail($id);

        $group->update($request->all());

        return $this->sendResponse($group, 'Group Information has been updated');
    }

    public function show($id)
    {
        // get a groups by id
        $group  = $this->group->findOrFail($id);
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
//        $this->authorize('isAdmin');

        $entity = Group::findOrFail($id);
        // delete the entity

        $entity->delete();

        return $this->sendResponse([$entity], 'Group has been Deleted');
    }

    public function all()
    {
        $group = $this->group->all();

        return $this->sendResponse($group, 'Group list');
    }

    public function users($id)
    {
        $entity = GroupUser::where('group_id', $id)->first();
        if (isset($entity->group_id)) {
            $data = $entity->users()->paginate(10);
            return $this->sendResponse($data, 'Members list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function members($id)
    {
        $users_id = GroupUser::where('group_id', $id)->pluck('user_id');
        if(count($users_id)){
            $users = DB::table('users')->whereIn('id', $users_id)->paginate(10);
            return $this->sendResponse($users, 'Members list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function  getGroupUsersByGroup($id){
        $ids = GroupUser::where('group_id', $id)->get();
        if(count($ids)){
            return $this->sendResponse($ids, 'Id Group Users list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function filter($value)
    {
        $users = DB::table('users')->where('name', 'LIKE', '%' . $value . '%')->get();
        if(count($users)){
            return $this->sendResponse($users, 'Users list');
        }
        $data = null;
        return $this->sendResponse($data, 'Group empty');
    }

    public function addUsers(Request $request)
    {
        $temp = GroupUser::where('user_id', $request->get('user_id'))->where('group_id', $request->get('group_id'))->get();
        if(count($temp)){
            $data = ['data' => ['data' => []]];
            return $this->sendResponse($data, 'User Already In Group');
        }else{
            $tag = GroupUser::create([
                'user_id' => $request->get('user_id'),
                'group_id' => $request->get('group_id'),
            ]);
            return $this->sendResponse($tag, 'User Added Successfully');
        }
    }

    public function removeUsers(Request $request)
    {
        GroupUser::whereIn('id', $request->get('ids'))->delete();
        $data = ['data' => ['data' => []]];
        return $this->sendResponse($data, 'User Remove Successfully');
    }
}
