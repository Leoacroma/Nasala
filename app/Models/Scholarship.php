<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarship';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_kh',
        'title_eng',
        'file',
        'dsc_kh',
        'dsc_eng',
    ];
}
