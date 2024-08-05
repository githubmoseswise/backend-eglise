<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExhortationController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupportTicketController;

// Authentification
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'register']);



// Utilisateurs
Route::apiResource('users', UserController::class);

// Contenus
Route::apiResource('pages', PageController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('media', MediaController::class);
Route::apiResource('links', LinkController::class);

// Notifications
Route::apiResource('notifications', NotificationController::class);

// Mises à jour
Route::apiResource('updates', UpdateController::class);

// Sauvegardes
Route::post('backup', [BackupController::class, 'backup']);

// Intégrations
Route::apiResource('integrations', IntegrationController::class);

// Paramètres
Route::apiResource('settings', SettingController::class);

// Rapports
Route::apiResource('reports', ReportController::class);

// Support technique
Route::apiResource('support-tickets', SupportTicketController::class);

// Exhortations
Route::apiResource('exhortations', ExhortationController::class);
