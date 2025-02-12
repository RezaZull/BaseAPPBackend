<?php

namespace App\Http\Controllers;

use App\Helper\ResponsHelper;
use App\Models\MUser;
use DB;
use Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class MUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchParam = $request->query('searchParam');
        $searchValue = $request->query('searchValue');
        $orderBy = $request->query('orderBy');
        $orderDir = $request->query('orderDir');

        $pagination = $request->query('pagination');
        $MUser = new MUser();
        if (isset($searchParam) && isset($searchValue)) {
            $MUser = $MUser->where($searchParam, 'LIKE', "%$searchValue%");
        }
        if (isset($orderBy) && isset($orderDir)) {
            $MUser = $MUser->orderBy($orderBy, $orderDir);
        }
        $MUser = isset($pagination) ? $MUser->paginate($pagination) : $MUser->get();

        return ResponsHelper::successGetData($MUser);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:m_users,username,NULL,NULL',
            'email' => 'required|email|unique:m_users,email,NULL,NULL',
            'password' => 'required',
            'id_m_roles' => 'exists:m_roles,id|required',
            'user_id' => 'required|exists:m_users,id'
        ]);

        if ($validator->fails()) {
            return ResponsHelper::validatorError($validator->errors());
        }
        DB::beginTransaction();
        try {
            $user = MUser::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_m_roles' => $request->id_m_roles,
                'obj_type' => $this->objTypes["M_User"],
                'created_by' => $request->user_id,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponsHelper::conflictError(409, "Conflict error");
        }
        if ($user) {
            return ResponsHelper::successChangeData($user, "Success create data");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MUser $mUser)
    {
        return ResponsHelper::successGetData($mUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MUser $mUser)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:m_users,username,NULL,NULL',
            'email' => 'required|email|unique:m_users,email,NULL,NULL',
            'id_m_roles' => 'exists:m_roles,id|required',
            'user_id' => 'required|exists:m_users,id'
        ]);

        if ($validator->fails()) {
            return ResponsHelper::validatorError($validator->errors());
        }
        DB::beginTransaction();
        $user = $mUser->updateOrFail([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'id_m_roles' => $request->id_m_roles,
            'updated_by' => $request->user_id,
        ]);
        if ($user) {
            DB::commit();
            return ResponsHelper::successChangeData($user, "Success create data");
        }
        DB::rollBack();
        return ResponsHelper::conflictError(409, "Conflict error");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MUser $mUser, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:m_users,id'
        ]);
        if ($validator->fails()) {
            return ResponsHelper::validatorError($validator->errors());
        }
        DB::beginTransaction();
        $mUser->update([
            'deleted_by' => $request->user_id
        ]);

        if ($mUser->delete()) {
            DB::commit();
            return ResponsHelper::successChangeData("true", "Successfully delete data");
        }
        DB::rollBack();
        return ResponsHelper::conflictError(409, "cant delete data");
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:m_users,username,NULL,NULL',
            'email' => 'required|email|unique:m_users,email,NULL,NULL',
            'password' => 'required',
            'id_m_roles' => 'exists:m_roles,id|required',
        ]);

        if ($validator->fails()) {
            return ResponsHelper::customResponse(442, false, "Validation error", [
                "error" => [
                    $validator->errors()
                ]
            ]);
        }

        $user = MUser::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_m_roles' => $request->id_m_roles,
            'obj_type' => $this->objTypes["M_User"],
            'created_by' => "SYSTEM",
        ]);

        if ($user) {
            return ResponsHelper::customResponse('201', true, "Success Register", [
                'data' => [
                    'user' => $user
                ]
            ]);
        }
        return ResponsHelper::customResponse(409, false, "Conflict error");

    }
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return ResponsHelper::validatorError($validation->errors());
        }
        $credential = $request->only('username', 'password');
        if (!$token = auth()->guard('api')->attempt($credential)) {
            return ResponsHelper::authError("Wrong Username or Password");
        }
        $dataUser = MUser::with('role.roleGroup.menuGroupDetail.menu')->find(auth()->guard('api')->user()->id);
        return ResponsHelper::customResponse(
            200,
            true,
            "success login",
            [
                'data' => [
                    'user' => $dataUser,
                ],
                'token' => $token
            ]
        );
    }
    public function logout()
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        return ResponsHelper::customResponse(200, true, "Success logout");
    }
}
