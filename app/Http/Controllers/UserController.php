<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UserController extends Controller
{
    //Insert User Function

    public function addUser(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $User = new User;
            $User->name=$request->name;
            $User->email=$request->email;
            $User->password=$request->password;
            $User->save();
            return $this->sendResponse([], 'User registered successfully.', true);
        }catch (Exception $e){
            return $this->sendError('Internal server Error.', $e->getMessage(), 413);
        }
    }
}
