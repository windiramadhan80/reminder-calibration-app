<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\AlatUkur;
use App\Models\DaftarEmail;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function index()
    {
        // Ambil semua event dari database
        $events = Event::all();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'desription' => $request->description,
            'color' => AlatUkur::where('nama', $request->title)->first()->color,
            'type' => $request->type,
            'start' => $request->start,
            'end' => $request->end,
        ];
        $event = Event::create($data);

        if ($event) {
            $daftar_email = DaftarEmail::all();
            if ($request->start) {
                $start = Carbon::parse($request->start)->translatedFormat('l, d F Y');
            }

            if ($request->end) {
                $end = Carbon::parse($request->end)->translatedFormat('l, d F Y');
            } else {
                $end = '';
            }

            foreach ($daftar_email as $recipient) {
                $data_email = [
                    'name' => $recipient->name,
                    'title' => $request->title,
                    'start' => $start,
                    'end' => $end,
                ];

                Mail::send('emails.send', $data_email, function ($message) use ($recipient, $request) {
                    $message->to($recipient->email, $recipient->name)
                        ->subject("Jadwal Kalibrasi $request->title");
                });
            }
        }
        return response()->json($event);
    }

    public function dropdown()
    {
        return response()->json(AlatUkur::all());
    }
}
