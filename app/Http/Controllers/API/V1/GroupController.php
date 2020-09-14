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
        return new GroupCollection($this->repository->getAll());
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
    public function store(GroupRequest $request)
    {
        try {
            $group = $this->service->createGroup($request->validated());
            return $this->sendSuccessResponse($group, __('group.infor.info.messages._create_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return $this->sendSuccessResponse(new GroupResource($this->repository->show($id)));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * Update the resource in storage
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(GroupRequest $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->validated());
            return $this->sendSuccessResponse($result, __('group.infor.info.messages._edit_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->service->delete($id);
            return $this->sendSuccessResponse($result);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function all()
    {
        try{
            $group = $this->group->all();
            return $this->sendSuccessResponse($group, __('group.infor.messages._data_result'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function members($id)
    {
        try{
            $group = $this->repository->find($id);
            return new UserCollection($group->users()->paginate(10));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function users($id)
    {
        try{
            $users_id = GroupUser::where('group_id', $id)->pluck('user_id');
            if(count($users_id)){
                $users = DB::table('users')->whereIn('id', $users_id)->paginate(10);
                return $this->sendSuccessResponse($users, __('group.infor.others._data_result'));
            }
            return response()->json(['data' => ['data' => []]]);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
        
    }

    public function getGroupUsersByGroup($id){
        try{
            $ids = GroupUser::where('group_id', $id)->get();
            if(count($ids)){
                return $this->sendSuccessResponse($ids, __('group.group_users.messages._data_result'));
            }
            return response()->json(['data' => ['data' => []]]);
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
        
    }

    public function filter($id, $value)
    {
        // try {
        //     $query = "SELECT users.id, users.name, users.email, users.created_at from users WHERE id in (select DISTINCT(users.id) from users LEFT JOIN group_users on users.id = group_users.user_id where users.id not in (select users.id from users JOIN group_users on group_users.user_id = users.id where group_users.group_id = $id)) and users.name like '%$value%'";

        //     $users = DB::select( DB::raw($query));
        //     if(count($users)){
        //         return $this->sendSuccessResponse($users,  __('group.group_users.others._data_result'));
        //     }
        //     return $this->sendSuccessResponse([], __('group.group_users.others._no_search_result'));
        // } catch (\Exception $exception) {
        //     return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        // }

        $result = $this->repository->filter($id, $value);
        dd($result);
    }

    public function addUsers(Request $request)
    {
        try {
            $group = DB::table('groups')->where('id', $request->get('group_id'))->first();
            if($group->name){
                        GroupUser::create([
                            'user_id' => $request->get('user_id'),
                            'group_id' => $group->id,
                        ]);
            }
            return $this->sendSuccessResponse([], __('group.infor.messages._update_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function removeUsers(Request $request)
    {
        try {
            GroupUser::whereIn('id', $request->get('ids'))->delete();
            $data = ['data' => ['data' => []]];
            return $this->sendSuccessResponse($data,  __('group.infor.messages._update_success'));
        } catch (\Exception $exception) {
            return $this->sendErrorResponse($exception->getCode(), $exception->getMessage());
        }
    }
}
