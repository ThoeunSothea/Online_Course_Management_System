<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseScheduleController;
use App\Http\Controllers\CourseCartController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\RequestCourseController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::resource('roles', RoleController::class);
// Route::resource('profiles', ProfileController::class);
// Route::resource('courses', CourseController::class);
// Route::resource('course-categories', CourseCategoryController::class);
// Route::resource('course-schedules', CourseScheduleController::class);
// Route::resource('course-carts', CourseCartController::class)->only(['index', 'store', 'destroy']);
// Route::resource('assignments', AssignmentController::class);
// Route::resource('quizzes', QuizController::class);
// Route::resource('enrollments', EnrollmentController::class)->only(['index', 'store', 'destroy']);
// Route::resource('materials', ContentController::class)->only(['index', 'create', 'store', 'destroy']);
// Route::resource('announcements', AnnouncementController::class)->only(['index', 'create', 'store', 'destroy']);
// Route::resource('approvals', ApprovalController::class);
// Route::resource('request-courses', RequestCourseController::class)->only(['index', 'create', 'store', 'destroy']);
