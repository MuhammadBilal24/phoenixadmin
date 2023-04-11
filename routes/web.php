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
Route::get('/users', [homeController::class, 'users']);
Route::post('/add/users',[homeController::class,'AddUser']);
Route::post('/edit/users',[homeController::class,'EditUser']);

//Courses
Route::get('/courses', [homeController::class, 'course']);
Route::post('/add/course',[homeController::class,'AddCourse']);
Route::post('/edit/course',[homeController::class,'EditCourse']);
Route::get('/courses/lectures/{courseID}',[homeController::class,'courselecture']);




Route::get('/facilitator', [homeController::class, 'facilitator']);
Route::get('/students', [homeController::class, 'student']);
Route::get('/admin', [homeController::class, 'admin']);










// ----------------------------------------------    API SECTION ----------------------------------------------------------------

// Course
Route::get('/api/Courseget/{courseID}',[apiController::class,'courseget']);
Route::get('/api/Coursedelete/{courseID}',[apiController::class,'coursedelete']);

// Student
Route::get('/api/Usersget/{userID}',[apiController::class,'userget']);
Route::get('/api/Userdelete/{userID}',[apiController::class,'userdelete']);

