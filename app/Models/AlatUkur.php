<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlatUkur extends Model
{
    use HasFactory;

    protected $table = 'alat_ukur';
    protected $guarded = ['id'];
}
