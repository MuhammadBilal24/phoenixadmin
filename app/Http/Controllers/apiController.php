<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class apiController extends Controller
{
    // course get
    public function courseget(request $request){
        $data = DB::table('courses')->where(['id_course'=>$request->courseID])->get();
        return $data;
    }
    // Delete Course
    public function coursedelete(request $request){
        $data = DB::table('courses')->where(['id_course'=>$request->courseID])->delete();
        return $data;
    }
    // user get
    public function userget(request $request){
        $data = DB::table('users')->where(['id_user'=>$request->userID])->get();
        return $data;
    }
    // Delete user
    public function userdelete(request $request){
        $data = DB::table('users')->where(['id_user'=>$request->userID])->delete();
        return $data;
    }
}
