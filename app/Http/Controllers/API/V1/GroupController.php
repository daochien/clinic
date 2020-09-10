<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;
use App\Repositories\GroupRepository;
use App\Services\GroupService;
use App\Http\Requests\Groups\GroupRequest;
use App\Models\User;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;

class GroupController extends BaseController
{
    protected $group = '';
    protected $repository;
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @param Group $group
     * @param GroupRepository $groupRepository
     */
    public function __construct(Group $group, GroupRepository $groupRepository, GroupService $groupService)
    {
        $this->group = $group;
        $this->repository = $groupRepository;
        $this->service = $groupService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $group = $this->group->latest()->withCount('group_users')->orderBy('id', 'desc')->paginate(10);
//        return $this->sendSuccessResponse($group, 'Group list');
          $groups = $this->repository->get();
          return new GroupCollection($groups);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $group = $this->group->pluck('name', 'id');

        return $this->sendSuccessResponse($group, 'Group list');
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
        $this->validate($request, [
            'name' => 'required|unique:groups',
        ]);
        $tag = $this->group->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'forced' => $request->get('forced'),
        ]);

        return $this->sendSuccessResponse($tag, 'Group Created Successfully');
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
        $this->validate($request, [
            'name' => 'required',
        ]);
        $group = $this->group->findOrFail($id);

        $group->update($request->all());

        return $this->sendSuccessResponse($group, 'Group Information has been updated');
    }

    public function show($id)
    {
        // get a groups by id
        $group  = $this->group->findOrFail($id);
        return $this->sendSuccessResponse($group, 'Group information');
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

        return $this->sendSuccessResponse([$entity], 'Group has been Deleted');
    }

    public function all()
    {
        $group = $this->group->all();

        return $this->sendSuccessResponse($group, 'Group list');
    }

    public function members($id)
    {
        $entity = GroupUser::where('group_id', $id)->first();
        if (isset($entity->group_id)) {
            $data = $entity->users()->paginate(10);
            return $this->sendSuccessResponse($data, 'Members list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function users($id)
    {
        $users_id = GroupUser::where('group_id', $id)->pluck('user_id');
        if(count($users_id)){
            $users = DB::table('users')->whereIn('id', $users_id)->paginate(10);
            return $this->sendSuccessResponse($users, 'Members list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function  getGroupUsersByGroup($id){
        $ids = GroupUser::where('group_id', $id)->get();
        if(count($ids)){
            return $this->sendSuccessResponse($ids, 'Id Group Users list');
        }
        return response()->json(['data' => ['data' => []]]);
    }

    public function filter($id, $value)
    {
        $query = "SELECT users.id, users.name, users.email, users.created_at from users WHERE id in (select DISTINCT(users.id) from users LEFT JOIN group_users on users.id = group_users.user_id where 1 and users.id not in (select users.id from users JOIN group_users on group_users.user_id = users.id where group_users.group_id = 6)) and users.name like '%$value%'";

        $users = DB::select( DB::raw($query));
        if(count($users)){
            return $this->sendSuccessResponse($users, 'Users list');
        }
        $data = null;
        return $this->sendSuccessResponse($data, 'Group empty');
    }

    public function addUsers(Request $request)
    {
        $temp = GroupUser::where('user_id', $request->get('user_id'))->where('group_id', $request->get('group_id'))->get();
        if(count($temp)){
            $data = ['data' => ['data' => []]];
            return $this->sendSuccessResponse($data, 'User Already In Group');
        }else{
            $tag = GroupUser::create([
                'user_id' => $request->get('user_id'),
                'group_id' => $request->get('group_id'),
            ]);
            return $this->sendSuccessResponse($tag, 'User Added Successfully');
        }
    }

    public function removeUsers(Request $request)
    {
        GroupUser::whereIn('id', $request->get('ids'))->delete();
        $data = ['data' => ['data' => []]];
        return $this->sendSuccessResponse($data, 'User Remove Successfully');
    }
}
