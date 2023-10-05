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
    // put api for update user details

    public function updateUserdetails(Request $request,$id){
        if ($request->ismethod('put')){
            $data = $request->all();
            // return $data;

            // validation custome

            $rules=[
                'name'=>'required',
                // 'email'=>'required|email|unique:users',
                'password'=>'required',
            ];

            $customMessage =[
                'name.required'=>'Name is required',
                // 'email.required'=>'Email is required',
                // 'email.email'=>'Email  must be a valid email',
                'password.required'=>'password is required',
            ];
               $validator = Validator::make( $data,$rules,$customMessage);
               if($validator->fails()){
                return response()->json($validator->errors(),422);
               }
            //    code single user jonno kora hoiche nicher ta code ta kora hoace
            $user = User::findOrFail($id);
            $user->name =$data['name'];
            // $user->email =$data['email'];
            $user->password=bcrypt($data['password']);
            $user->save();
            $massage='user succesfully Updeated';
            return response()->json(['message'=>$massage],202);

        }
    }
    // patch single update record
    public function updateSingleRecord(Request $request,$id){
        if ($request->ismethod('patch')){
            $data = $request->all();
            // return $data;

            // validation custome

            $rules=[
                'name'=>'required',
                // 'email'=>'required|email|unique:users',
                // 'password'=>'required',
            ];

            $customMessage =[
                'name.required'=>'Name is required',
                // 'email.required'=>'Email is required',
                // 'email.email'=>'Email  must be a valid email',
                // 'password.required'=>'password is required',
            ];
               $validator = Validator::make( $data,$rules,$customMessage);
               if($validator->fails()){
                return response()->json($validator->errors(),422);
               }
            //    code single user jonno kora hoiche nicher ta code ta kora hoace
            $user = User::findOrFail($id);
            $user->name =$data['name'];
            // $user->email =$data['email'];
            // $user->password=bcrypt($data['password']);
            $user->save();
            $massage='user succesfully Updeated';
            return response()->json(['message'=>$massage],202);

        }
    }
    // deleted single data deleted user table for api 
    // 200 is a statuse ok......
    public function DeleteSingleRecord($id=null)
    {
        User:: findOrFail($id)->delete();
        $message = 'user Succesfully Deleted';
        return response()->json(['message'=>$message],202);


    }
    // Detete api for delete  user with json
// json formet e delete korte gale id use kora lagbe na
   
    
public function deleteUserJson(Request $request){

    if ($request->isMethod('delete'))
    {
      $data =$request->all();
      User:: where('id',$data['id'])->delete();
      $message ='User Successfully Deleted';
      return response()->json(['message'=>$message],200);
    }

    
}
//  multiple users deleted for api 
// explode() akta method nia nicche
// url e jokon multiple id patha bo sie  id gulake $ids dia dhore
// $ids variable dia dhore explode korbo (',') madhome alada kore dibo rakhe dibo $id=variable moddhe
// Users model roeche query chalate pari whwreIn kore database ji 'id'ta roecha match korabo
// karsathe amr ji $ids gula pacche tr sathe jigula match korbe sie gula delete kore dibe


public function deleteMultiple($ids){
    $ids = explode(',',$ids);
    User::whereIn('id',$ids)->delete();
    $message ='User Successfully Deleted';
    return response()->json(['message'=>$message],200);
}


// delete multiple user with json
// Request class ta nita hobe Request class er ki thake akta  Object($request)
// er por akta condition chalate pari if($request)-> ai $request isMthode ta (delete) hoi tahole ki hobe ai kaj ta 
// $data amra akta variable nia nie akn thake,orthat joto data assbe json thake sagula ke ki korbo amra dhorbo aikhan thake ->all()
// tarpor amra akta query chala te pari,prothome amra User:: model ta dhorlam aikhane whereIn kore ,database er ji 'id' ta dhore aitake match korbo kar sathe $data['ids']
// ai 'ids' ta konta url e jeson formet e send krbo aita akta name akn amra aikhan thake ->delete() korte pari
public function deleteMultipleUserJson(Request $request){
    if($request->isMethod('delete')){
        $data =$request->all();
        User::whereIn('id',$data['ids'])->delete();
        $message ='User Successfully Deleted';
    return response()->json(['message'=>$message],200);
    }

}




  public function deleteAuthorizationMultipleUserJson(Request $request){
   $header =$request->header('Authorization');
    if($header==''){
    $message ='Authorization is required';
    return response()->json(['message'=>$message],422);
   }else{

    if($header=='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6ImFtaXRoYXNhbmZheXNhbCIsImlhdCI6MTUxNjIzOTAyMn0.FcCsPUIKynkdXi8TaaK_3K9rn5F2wwISjts7PrqhJDQ')
    {
        if($request->isMethod('delete'))
        {
            $data =$request->all();
            User::whereIn('id',$data['ids'])->delete();
            $message ='User Successfully Deleted';
        return response()->json(['message'=>$message],200);
    }
    }else{
        $message ='Authorization doesnot match';
        return response()->json(['message'=>$message],422);
    }
}

 
}

}