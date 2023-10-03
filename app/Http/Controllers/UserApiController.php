<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UserApiController extends Controller
{
    public function showUser($id=null){
        if($id=='')
        {
            $users = User::get();
            return response()->json(['users'=>$users],200);
        }else
        {
            $users=User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }

    public function addUser(Request $request){
        if ($request->ismethod('post')){
            $data = $request->all();
            // return $data;

            // validation custome

            $rules=[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
            ];

            $customMessage =[
                'name.required'=>'Name is required',
                'email.required'=>'Email is required',
                'email.email'=>'Email  must be a valid email',
                'password.required'=>'password is required',
            ];
               $validator = Validator::make( $data,$rules,$customMessage);
               if($validator->fails()){
                return response()->json($validator->errors(),422);
               }
            //    code single user jonno kora hoiche nicher ta code ta kora hoace
            $user =new User();
            $user->name =$data['name'];
            $user->email =$data['email'];
            $user->password=bcrypt($data['password']);
            $user->save();
            $massage='user succesfully added';
            return response()->json(['message'=>$massage],201);

        }
    }
// post api for add multiple users

    public function addMultipleUser(Request $request){
        if ($request->ismethod('post')){
            $data = $request->all();
            // return $data;

            // validation custome
// users.*. mutiple users add er jonno ji ['users'] array use kora hoice tar jonno 
// multiple datar jonno protita validation e users.*. use kora hoice
            $rules=[
                'users.*.name'=>'required',
                'users.*.email'=>'required|email|unique:users',
                'users.*.password'=>'required',
            ];

            $customMessage =[
                'users.*.name.required'=>'Name is required',
                'users.*.email.required'=>'Email is required',
                'users.*.email.email'=>'Email  must be a valid email',
                'users.*.password.required'=>'password is required',
            ];
               $validator = Validator::make( $data,$rules,$customMessage);
               if($validator->fails()){
                return response()->json($validator->errors(),422);
               }
            // $user =new User();
            // $user->name =$data['name'];
            // $user->email =$data['email'];
            // $user->password=bcrypt($data['password']);
            // $user->save();
            // $massage='user succesfully added';
            // return response()->json(['message'=>$massage],201);


// multiple users er jonno code kora hoiche 
// amra jokon api er maddhome data pathabo si api er 
// moddhe akta array create korbo users api er maddhome akta array create kora 
// hoache abong oi array name ti hocche users
            foreach($data['users'] as $adduser){
                $user =new User();
                $user->name =$adduser['name'];
                 $user->email =$adduser['email'];
                 $user->password=bcrypt($adduser['password']);
                 $user->save();
                 $massage='user succesfully added';
                //  return response()->json(['message'=>$massage],201);
            }
            return response()->json(['message'=>$massage],201);

        }
    }
}
