<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{

    // Course
    public function course()
    {
        $Course_data=DB::table('courses')->get();
        // return $data;
        return view('courses',['Course_data'=>$Course_data]);
    }
    // Add Course
    public function AddCourse(request $request){
        $arr=[
            'course_title'=>$request->course_title,
            'course_desc'=>$request->course_desc,
        ];
            DB::table('courses')->insert($arr);
        return redirect('/courses');
    }
    // Edit Course
    public function EditCourse(request $request){
        $arr=[
            'id_course'=>$request->id_course,
            'course_title'=>$request->course_title,
            'course_desc'=>$request->course_desc,
        ];
            DB::table('courses')->where(['id_course'=>$request->id_course])->update($arr);
        return redirect('/courses');
    }
    // Single Course Lecture
    public function courselecture(request $request)
    {
        $Lecture_data=DB::table('lectures')->where(['id_course'=>$request->courseID])->orderBy('order_no', 'desc')->get();
        return view('lectures',['Lecture_data'=>$Lecture_data]);
    }


    public function student()
    {
        $Users_data=DB::table('users')
        ->join('students', 'students.id_user', '=', 'users.id_user')
        ->get();
        return view('students',['Users_data'=>$Users_data]);
    }

    // Add Student
    public function AddUser(request $request){
        $arr=[
            'email_user'=>$request->email_user,
            'pass_user'=>$request->pass_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
            DB::table('users')->insert($arr);
            return redirect('/students');
    }

    // Edit User
    public function EditUser(request $request){
        $arr=[
            'id_user'=>$request->id_user,
            'email_user'=>$request->email_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
            DB::table('users')->where(['id_user'=>$request->id_user])->update($arr);
        return redirect('/students');
    }



    public function facilitator()
    {
        return view('facilitator');
    }

    public function admin()
    {
        return view('admin');
    }
}
