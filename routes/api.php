<?php

use App\Http\Controllers\Api\DashboardController as ApiDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController as ApiRoleController;
use App\Http\Controllers\Api\ProfileController as ApiProfileController;
use App\Http\Controllers\Api\CourseController as ApiCourseController;
use App\Http\Controllers\Api\CourseCategoryController as ApiCourseCategoryController;
use App\Http\Controllers\Api\CourseScheduleController as ApiCourseScheduleController;
use App\Http\Controllers\Api\CourseCartController as ApiCourseCartController;
use App\Http\Controllers\Api\AssignmentController as ApiAssignmentController;
use App\Http\Controllers\Api\QuizController as ApiQuizController;
use App\Http\Controllers\Api\EnrollmentController as ApiEnrollmentController;
use App\Http\Controllers\Api\MaterialController as ApiMaterialController;
use App\Http\Controllers\Api\AnnouncementController as ApiAnnouncementController;
use App\Http\Controllers\Api\ApprovalController as ApiApprovalController;
use App\Http\Controllers\Api\RequestCourseController as ApiRequestCourseController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('/dashboard', [ApiDashboardController::class, 'index']);


// Protected Routes (requires auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // User Profile
    Route::get('/profile', [ApiProfileController::class, 'show']);
    Route::put('/profile', [ApiProfileController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Roles
    Route::apiResource('roles', ApiRoleController::class);

    // Courses
    Route::apiResource('courses', ApiCourseController::class);

    // Categories
    Route::apiResource('course-categories', ApiCourseCategoryController::class);

    // Schedules
    Route::apiResource('course-schedules', ApiCourseScheduleController::class);

    // Course Carts
    Route::get('/course-carts', [ApiCourseCartController::class, 'index']);
    Route::post('/course-carts', [ApiCourseCartController::class, 'store']);
    Route::delete('/course-carts/{id}', [ApiCourseCartController::class, 'destroy']);

    // Assignments
    Route::apiResource('assignments', ApiAssignmentController::class);

    // Quizzes
    Route::apiResource('quizzes', ApiQuizController::class);

    // Enrollments
    Route::get('/enrollments', [ApiEnrollmentController::class, 'index']);
    Route::post('/enrollments', [ApiEnrollmentController::class, 'store']);
    Route::delete('/enrollments/{id}', [ApiEnrollmentController::class, 'destroy']);

    // Materials
    Route::apiResource('materials', ApiMaterialController::class)->only(['index','store','destroy']);

    // Announcements
    Route::apiResource('announcements', ApiAnnouncementController::class)->only(['index','store','destroy']);

    // Approvals
    Route::apiResource('approvals', ApiApprovalController::class);

    // Request Courses
    Route::apiResource('request-courses', ApiRequestCourseController::class)->only(['index','store','destroy']);
});
