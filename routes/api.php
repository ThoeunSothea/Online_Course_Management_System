<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\RequestCourseController;

// ================= PUBLIC ROUTES ==================
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Dashboard (auth only)
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:lecturer'])->group(function () {
    Route::get('/lecturer/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [DashboardController::class, 'index']);
});


// ================= AUTH REQUIRED ==================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn(Request $req) => response()->json(['user' => $req->user()]));

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
});


// ================= ADMIN ROUTES ==================
Route::middleware(['auth:sa nctum', 'role:admin'])->group(function () {
    Route::get('/users', [AuthController::class, 'index']);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('approvals', ApprovalController::class);
    Route::apiResource('course-categories', CourseCategoryController::class);
    Route::apiResource('courses', CourseController::class)->only(['index', 'show', 'destroy']);
});


// ================= LECTURER ROUTES ==================
Route::middleware(['auth:sanctum', 'role:lecturer'])->group(function () {
    // Manage own courses
    Route::apiResource('courses', CourseController::class)->only(['index','store','update','show']);
    Route::apiResource('course-schedules', CourseScheduleController::class);
    Route::apiResource('assignments', AssignmentController::class);
    Route::apiResource('quizzes', QuizController::class);
    Route::apiResource('materials', MaterialController::class)->only(['index','store','destroy']);
    Route::apiResource('announcements', AnnouncementController::class)->only(['index','store','destroy']);
});


// ================= STUDENT ROUTES ==================
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/enrollments', [EnrollmentController::class, 'index']);
    Route::post('/enrollments', [EnrollmentController::class, 'store']);
    Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);

    Route::get('/course-carts', [CourseCartController::class, 'index']);
    Route::post('/course-carts', [CourseCartController::class, 'store']);
    Route::delete('/course-carts/{id}', [CourseCartController::class, 'destroy']);

    Route::apiResource('request-courses', RequestCourseController::class)->only(['index','store','destroy']);
});
