<?php

use App\Models\PageVisit;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('frontend/pages/welcome');
});
Route::get('/application', function () {
    return view('frontend/pages/application');
});
Route::get('/calculator', function () {
    return view('frontend/pages/calculator');
});
Route::get('/impressum', function () {
    return view('frontend/pages/impressum');
});
Route::get('/datenschutz', function () {
    return view('frontend/pages/privacy');
});
Route::get('/datenschutzerklaerung', function () {
    return view('frontend/pages/privacy');
});


/* advertising links */
Route::get('/ueber-uns', function () {
    return redirect('/#about');
});
Route::get('/kalkulator', function () {
    return view('frontend/pages/calculator');
});
Route::get('/hausmeister', function () {
    return redirect('/#services');
});
Route::get('/kontakt', function () {
    return redirect('/#contact');
});
Route::get('/hausverwaltung', function () {
    return redirect('/#360');
});
Route::get('/leistungsportfolio', function () {
    return redirect('/#services');
});

Route::get('/hausinstandhaltung', function () {
    return redirect('/#360');
});
Route::get('/leistungsportfolio', function () {
    return redirect('/#services');
});
Route::get('/leistungsportfolio', function () {
    return redirect('/#services');
});
Route::get('/team', function () {
    return redirect('/#about');
});
Route::get('/fuer-mieter', function () {
    return redirect('/#fuer-mieter');
});
Route::get('/fuer-wegs', function () {
    return redirect('/#fuer-wegs');
});
Route::get('/fuer-eigenheimbesitzer', function () {
    return redirect('/#fuer-eigenheimbesitzer');
});
Route::get('/fuer-gewerbekunden', function () {
    return redirect('/#fuer-gewerbekunden');
});
Route::get('/stellenangebote', function () {
    return redirect('/#application');
});

Route::get('/wp-content/uploads/2025/02/Flyer-Hausverwaltung-Rueckseite.pdf', function () {
    return redirect('/images/fmi/flyer/Felix_Machts_Flyer.pdf');
});
Route::get('/wp-content/uploads/2025/02/Flyer_FU5-Rueckseite.pdf', function () {
    return redirect('/images/fmi/flyer/Felix_Machts_Flyer.pdf');
});
Route::get('/wp-content/uploads/2025/02/Flyer_FU10-Rueckseite.pdf', function () {
    return redirect('/images/fmi/flyer/Felix_Machts_Flyer.pdf');
});
Route::get('/wp-content/uploads/2025/02/Flyer_FU4_Vorderseite.pdf', function () {
    return redirect('/images/fmi/flyer/Felix_Machts_Flyer.pdf');
});


Route::get('/login', function () {
    return view('global/pages/auth/login');
})->middleware('guest:' . implode(',', array_keys(config('auth.guards'))))->name('login');

Route::get('/forgot-password', function () {
    return view('global/pages/password/forgot-password');
})->name('forgot-password');


Route::get('/', function () {
    $alreadyVisited = PageVisit::where('page', 'home')
        ->where('ip_address', Request::ip())
        ->where('created_at', '>=', now()->subHour())
        ->exists();

    if (!$alreadyVisited) {
        PageVisit::create([
            'page' => 'home',
            'ip_address' => Request::ip(),
        ]);
    }

    return view('frontend.pages.welcome');
});
