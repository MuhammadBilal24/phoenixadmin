<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class apiController extends Controller
{

    protected  $keyData;

    public function __construct()
    {
        $this->keyData = "1sad5f31dsaf531sda3f5sda1f";
    }
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


    //login user
    public function loginUser(Request $req){
        return $req;
    }

    //user registeration
    public function studentRegistration(Request $req){

        if($req->keyCode == $this->keyData){

            $validator = Validator::make($req->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Name is requried',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email address',
                    'errors' => $validator->errors(),
                ], 422);
            }


            $validator = Validator::make($req->all(), [
                'pass' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password is weak',
                    'errors' => $validator->errors(),
                ], 422);
            }
            if($req->pass != $req->passConfirm){
                return response()->json([
                    'success' => false,
                    'message' => 'Password dosen\'t match',

                ], 422);
            }

            $data = DB::table('users')->where(['email_user' => $req->email])->get();

            if (count($data) == 0){
                $arr = [
                    "email_user" => $req->email,
                    "pass_user" => $req->pass,
                    "name_user" => $req->name,
                    "status_user" => 1,
                    "pic_user" => "samplePic.jpg",
                    "bio_user" => "",
                    "academy_user" => "",
                    "isStudent_user" => 1,
                    "isFacilitator_user" => 0,
                ];

                $lastID = DB::table('users')->insertGetId($arr);
                $isInvited = 0;
                if(strlen($req->walletCode) > 0){
                    $walletData = DB::table('walletCode')->where(['code_wallet' => $req->walletCode])->get();

                    if(count($walletData) > 0){
                        if($walletData->total_wallet < $walletData->used_wallet){
                            $isInvited = 1;
                        }else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Wallet code is expired',
                                'walletCode' => 0,
                            ], 422);
                        }
                    }else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Wallet code is invalid',
                            'walletCode' => 0,
                        ], 422);
                    }
                }
                $arr = [
                    "id_user" => $lastID,
                    "is_invited" => $isInvited
                ];

            }else {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already registered',

                ], 422);
            }
        }

        return 0;
    }
}


