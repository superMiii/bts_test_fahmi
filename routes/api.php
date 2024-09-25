<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Checklist Endpoints
    Route::get('/checklists', [ChecklistController::class, 'index']);
    Route::post('/checklists', [ChecklistController::class, 'store']);
    Route::delete('/checklists/{checklist}', [ChecklistController::class, 'destroy']);

    // Checklist Items Endpoints
    Route::get('/checklists/{checklist}/items', [ChecklistItemController::class, 'index']);
    Route::post('/checklists/{checklist}/items', [ChecklistItemController::class, 'store']);
    Route::get('checklists/{checklist}/item/{checklistItem}', [ChecklistItemController::class, 'show']);
    Route::put('checklists/{checklist}/item/{checklistItem}', [ChecklistItemController::class, 'update']);
    Route::delete('checklists/{checklist}/item/{checklistItem}', [ChecklistItemController::class, 'destroy']);
    Route::put('checklists/{checklist}/item/rename/{checklistItem}', [ChecklistItemController::class, 'rename']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});