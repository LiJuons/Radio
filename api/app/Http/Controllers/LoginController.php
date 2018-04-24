<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class LoginController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($request['password']!=$request['c_password']){
            return response()->json(['error'=>'The password and the repeated password do not match.'], 412);
        }

        if(User::where('username','=',$request['username'])->first() != null){
            return response()->json(['error'=>'A user with this username already exists.'], 409);
        }

        if ($validator->fails()) {
            return response()->json(['error'=>'An error occured. Please check the input data.'], 406); //validator->errors()], 412);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }


    public function changePassword(Request $request){
        $messages = [
            'password.required' => 'Please enter current password',
            'c_password.same' => 'Confirmation password must match new password'
        ];

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required',
            'c_password' => 'required|same:new_password'
        ], $messages);

        if(Auth::check()){
            if($validator->fails()){
                return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
            } else {
                $current_password = Auth::user()->password;
                if(Hash::check($request['password'], $current_password)){
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request['new_password']);;
                    $obj_user->save();
                    return response()->json(['success' => 'successfully changed password']);
                } else {
                    $error = array('current-password' => 'Please enter correct current password');
                    return response()->json(array('error' => $error), 400);
                }
            }
        }
    }

}
