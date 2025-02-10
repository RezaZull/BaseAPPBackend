<?php

namespace App\Http\Controllers;

use App\Helper\ResponsHelper;
use App\Models\MUser;
use Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class MUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ResponsHelper::successGetData(MUser::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MUser $mUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MUser $mUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MUser $mUser)
    {
        //
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
            return ResponsHelper::validatorError($validator->errors());
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
            return ResponsHelper::successChangeData($user);
        }

        return ResponsHelper::conflictError("409");

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

        return ResponsHelper::successGetData([
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], "Success Login");
    }
    public function logout()
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        return ResponsHelper::successGetData("Success logout");
    }
}
