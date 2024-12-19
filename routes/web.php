<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\AlatUkur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlatUkurController;
use App\Http\Controllers\DaftarEmailController;

Route::get('/', function () {
    $alat_ukur = AlatUkur::all();
    $event_planning = Event::select('title')
        ->distinct()
        ->where('type', 'planning')
        ->get();
    $event_actual = Event::select('title')
        ->distinct()
        ->where('type', 'actual')
        ->get();

    $data = [
        'alat_ukur' => $alat_ukur,
        'event_planning' => $event_planning,
        'event_actual' => $event_actual,
    ];
    return view('events.index', $data);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

Route::get('/check-login', function () {
    if (Auth::user()) {
        return response()->json(['isLoggedIn' => true]);
    } else {
        return response()->json(['isLoggedIn' => false]);
    }
});


Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::get('/get-alat-ukur', [AlatUkurController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/send-email', function () {
        $data = [
            'name' => 'Windi Ramadhan',
        ];

        Mail::send('emails.send', $data, function ($message) {
            $message->to('windiramadhan80@gmail.com', 'Recipient Name')
                ->subject('Welcome to Our Platform');
        });

        return 'Email sent successfully!';
    });
    Route::post('/logout', [LoginController::class, 'destroy']);

    Route::get('/daftar-email', [DaftarEmailController::class, 'index']);
    Route::get('/daftar-email/create', [DaftarEmailController::class, 'create']);
    Route::post('/daftar-email/store', [DaftarEmailController::class, 'store']);
    Route::get('/daftar-email/edit/{id}', [DaftarEmailController::class, 'edit']);
    Route::put('/daftar-email/update/{id}', [DaftarEmailController::class, 'update']);
    Route::delete('/daftar-email/delete/{id}', [DaftarEmailController::class, 'destroy']);
});
