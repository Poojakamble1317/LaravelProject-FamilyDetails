<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyDataController;
use App\Models\FamilyHeadModel;

// Route::get('/', function () { return view('dashboard');});
Route::get('/', function () {return view('dashboard');})->name('dashboard');
//head route
Route::get("/family_head",[FamilyDataController::class,'index'])->name('family_head');
Route::get('/family_head/add',[FamilyDataController::class,'add_head']);
Route::post('/add_family_head',[FamilyDataController::class,'store_head'])->name('store.family_head');

//member route
Route::get("/family_member",[FamilyDataController::class,'family_member'])->name('family_member');
Route::get('/family_member/add',[FamilyDataController::class,'add_member']);
Route::post('/add_family_member',[FamilyDataController::class,'store_member'])->name('store.family_member');

Route::Post("/family_head/getState",[FamilyDataController::class,'get_state']);
Route::post("/family_head/getCities",[FamilyDataController::class,'get_cities']);
