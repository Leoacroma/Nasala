<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    protected $table = 'enroll';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_enroll_kh',
        'title_enroll_eng',
        'dsc_en_kh',
        'dsc_en_eng'
    ];
}
