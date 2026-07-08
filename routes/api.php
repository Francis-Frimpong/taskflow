<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CommentController;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('projects.task', TaskController::class)->shallow();
Route::apiResource('task.comments', CommentController::class)->shallow();