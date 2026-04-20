<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MangaController;

Route::get('/login', function () {
    return view('password');
});

Route::post('/login', function (Request $request) {

    if ($request->password === 'manga') {
        session(['auth' => true]);
        return redirect('/');
    }

    return back()->with('error', 'パスワードが違います');
});


Route::get('/', function () {

    if (!session('auth')) {
        return redirect('/login');
    }

    return app(MangaController::class)->index();

})->name('library');


Route::get('/viewer/{slug}', function ($slug, Request $request) {

    if (!session('auth')) {
        return redirect('/login');
    }

    return app(MangaController::class)->show($slug, $request);

})->name('viewer');