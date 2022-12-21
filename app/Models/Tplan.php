<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tplan extends Model
{
    use HasFactory;
    protected $table = 'tplan';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_kh',
        'title_eng',
    ];

}
