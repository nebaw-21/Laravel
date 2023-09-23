<?php
use App\Http\Controllers\LinkController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Link;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
     
     Route::POST('/user', [UserController::class, 'user']);
     Route::POST('/logout', [UserController::class, 'logout']);
  
 });

 /* login and registration of admin */
 Route::POST('/register', [UserController::class, 'registration']);
 Route::post('/login', [UserController::class, 'login']);
 Route::POST('/displayUser', [UserController::class, 'displayUser']);
 Route::POST('/addUser', [UserController::class, 'addUser']);
 Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
 Route::POST('/displaySpecificUser/{id}', [UserController::class, 'displaySpecificUser']);
 Route::PUT('/updateUser/{id}', [UserController::class, 'updateUser']);
 

/* about me information */

Route::POST('/addInformation', [InformationController::class, 'addInformation']);
Route::POST('/displayInformation', [InformationController::class, 'displayInformation']);
Route::POST('/updateInformation/{id}', [InformationController::class, 'updateInformation']);
Route::POST('/displaySpecificInformation/{id}', [InformationController::class, 'displaySpecificInformation']);

/* Social media Links */

Route::POST('/addLink', [LinkController::class, 'addLink']);
Route::POST('/displayLink', [LinkController::class, 'displayLink']);
Route::POST('/updateLink/{id}', [LinkController::class, 'updateLink']);
Route::POST('/displaySpecificLink/{id}', [LinkController::class, 'displaySpecificLink']);

/* Testimonial */

Route::POST('/addTestimonial', [TestimonialController::class, 'addTestimonial']);
Route::POST('/displayTestimonial', [TestimonialController::class, 'displayTestimonial']);
Route::POST('/updateTestimonial/{id}', [TestimonialController::class, 'updateTestimonial']);
Route::POST('/displaySpecificTestimonial/{id}', [TestimonialController::class, 'displaySpecificTestimonial']);
Route::delete('/deleteTestimonial/{id}', [TestimonialController::class, 'deleteTestimonial']);

/* Education */

Route::POST('/addEducation', [EducationController::class, 'addEducation']);
Route::POST('/displayEducation', [EducationController::class, 'displayEducation']);
Route::POST('/updateEducation/{id}', [EducationController::class, 'updateEducation']);
Route::POST('/displaySpecificEducation/{id}', [EducationController::class, 'displaySpecificEducation']);
Route::delete('/deleteEducation/{id}', [EducationController::class, 'deleteEducation']);

/* Experience */

Route::POST('/addExperience', [ExperienceController::class, 'addExperience']);
Route::POST('/displayExperience', [ExperienceController::class, 'displayExperience']);
Route::POST('/updateExperience/{id}', [ExperienceController::class, 'updateExperience']);
Route::POST('/displaySpecificExperience/{id}', [ExperienceController::class, 'displaySpecificExperience']);
Route::delete('/deleteExperience/{id}', [ExperienceController::class, 'deleteExperience']);

Route::POST('/contact', [ContactController::class, 'sendEmail']);