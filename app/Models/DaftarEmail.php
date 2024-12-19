<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarEmail extends Model
{
    use HasFactory;

    protected $table = 'daftar_email';
    protected $guarded = ['id'];
}
