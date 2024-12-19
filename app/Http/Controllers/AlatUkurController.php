<?php

namespace App\Http\Controllers;

use App\Models\AlatUkur;
use Illuminate\Http\Request;

class AlatUkurController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $alat_ukur = AlatUkur::all();
            return response()->json([
                'success' => true,
                'alat_ukur' => $alat_ukur
            ]);
        } else {
            echo 'Data tidak dapat diproses';
        }
    }
}
