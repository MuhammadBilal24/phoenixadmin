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

    // All Students
    public function student(request $request)
    {
        $Users_data=DB::table('users')
        ->join('students', 'students.id_user', '=', 'users.id_user')
        ->get();
        // return $Users_data;
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

    // Edit Studnet
    public function EditUser(request $request){
        $arr1=[
            'id_user'=>$request->id_user,
            'email_user'=>$request->email_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
        $arr2=[
            'id_user'=>$request->id_user,
            'is_invited'=>$request->is_invited,
            'wallet_code'=>$request->wallet_code,
        ];
            DB::table('users')->where(['id_user'=>$request->id_user])->update($arr1);
            DB::table('students')->where(['id_user'=>$request->id_user])->update($arr2);
        return redirect('/students');
    }

    // Invited Students
    public function invitedstudent()
    {
        $Users_data=DB::table('users')
        ->join('students', 'students.id_user', '=', 'users.id_user')
        ->get();
        return view('invitedstudents',['Users_data'=>$Users_data]);
    }
    // Add Invited Student
    public function AddinvitedStudent(request $request){
        $arr1=[
            'email_user'=>$request->email_user,
            'pass_user'=>$request->pass_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
        $arr2=[
            'is_invited'=>$request->is_invited,
            'wallet_code'=>$request->wallet_code,
        ];
            DB::table('users')->insert($arr1);
            DB::table('students')->insert($arr2);
            return redirect('/invitedstudents');
    }
    // Edit Invited Studnet
    public function EditinvitedStudent(request $request){
        $arr1=[
            'id_user'=>$request->id_user,
            'email_user'=>$request->email_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
        $arr2=[
            'id_student'=>$request->id_student,
            'id_user'=>$request->id_user,
            'is_invited'=>$request->is_invited,
            'wallet_code'=>$request->wallet_code,
        ];
            DB::table('users')->where(['id_user'=>$request->id_user])->update($arr1);
            DB::table('students')->where(['id_user'=>$request->id_user])->update($arr2);
        return redirect('/invitedstudents');
    }

    // Main App Students
    public function mainappstudent(){
        $Users_data=DB::table('students')
        ->join('users', 'users.id_user', '=', 'students.id_user')
        ->get();
        // return $Users_data;
        return view('mainappstudents',['Users_data'=>$Users_data]);
        }
     // Add mainapp Student
     public function AddappStudent(request $request){
        $arr1=[
            'email_user'=>$request->email_user,
            'pass_user'=>$request->pass_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
            DB::table('users')->insert($arr1);
            return redirect('/mainappstudents');
    }
    // Edit mainapp Studnet
    public function EditappStudent(request $request){
        $arr1=[
            'id_user'=>$request->id_user,
            'email_user'=>$request->email_user,
            'name_user'=>$request->name_user,
            'status'=>$request->status,
        ];
            DB::table('users')->where(['id_user'=>$request->id_user])->update($arr1);
        return redirect('/mainappstudents');
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
