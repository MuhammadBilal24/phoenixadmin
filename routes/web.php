<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\apiController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\loginController;
use App\Http\Controllers\homeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/login', [loginController::class, 'index']);

// Students
Route::get('/students', [homeController::class, 'student']);
Route::post('/add/allstudent',[homeController::class,'AddUser']);
Route::post('/edit/allstudent',[homeController::class,'EditUser']);

// Invited Students
Route::get('/invitedstudents', [homeController::class, 'invitedstudent']);
Route::post('/add/invitedstudent',[homeController::class,'AddinvitedStudent']);
Route::post('/edit/invitedstudent',[homeController::class,'EditinvitedStudent']);


// Main App Students
Route::get('/mainappstudents', [homeController::class, 'mainappstudent']);
Route::post('/add/appstudent',[homeController::class,'AddappStudent']);
Route::post('/edit/appstudent',[homeController::class,'EditappStudent']);

// Facilitator
Route::get('/facilitator', [homeController::class, 'facilitator']);
Route::post('/add/facilitator',[homeController::class,'Addfacilitator']);
Route::post('/edit/facilitator',[homeController::class,'Editfacilitator']);
Route::get('/facilitator/courses/{faciliatatorID}',[homeController::class,'facilitatorcourses']);


//Courses
Route::get('/courses', [homeController::class, 'course']);
Route::post('/add/course',[homeController::class,'AddCourse']);
Route::post('/edit/course',[homeController::class,'EditCourse']);
Route::get('/courses/lectures/{courseID}',[homeController::class,'courselecture']);




Route::get('/admin', [homeController::class, 'admin']);


// Notification
Route::get('/notification', [homeController::class, 'notification']);







// ----------------------------------------------    API SECTION ----------------------------------------------------------------

// Course
Route::get('/api/Courseget/{courseID}',[apiController::class,'courseget']);
Route::get('/api/Coursedelete/{courseID}',[apiController::class,'coursedelete']);

// All Student
Route::get('/api/Studentget/{studentID}',[apiController::class,'studentget']);
Route::get('/api/Studentdelete/{studentID}',[apiController::class,'studentdelete']);

// facilitator
Route::get('/api/facilitatorget/{facilitatorID}',[apiController::class,'facilitatorget']);
Route::get('/api/facilitatordelete/{facilitatorID}',[apiController::class,'facilitatordelete']);

// Route::get('/api/Studentget/{studentID}',[apiController::class,'mainappstudentget']);
