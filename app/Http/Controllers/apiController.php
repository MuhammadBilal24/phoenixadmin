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
    // student get
    public function studentget(request $request){
        $data = DB::table('users')
        ->join('students', 'students.id_user', '=', 'users.id_user')
        ->where(['users.id_user'=>$request->studentID])
        ->get();
        return $data;
    }
    // Delete student
    public function studentdelete(request $request){
        $data = DB::table('users')->where(['id_user'=>$request->studentID])->delete();
        return $data;
    }
    // MainApp Student get
    public function mainappstudentget(request $request){
        $data = DB::table('users')
        ->where(['users.id_user'=>$request->studentID])
        ->get();
        return $data;
    }
    // Facilitator get
     public function facilitatorget(request $request){
        $data = DB::table('users')
        ->join('facilitators', 'facilitators.id_user', '=', 'users.id_user')
        ->where(['users.id_user'=>$request->facilitatorID])
        ->get();
        return $data;
    }
    // Facilitator Delete
    public function facilitatordelete(request $request){
        $data = DB::table('users')->where(['id_user'=>$request->facilitatorID])->delete();
        return $data;
    }
}


