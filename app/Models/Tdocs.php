<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tdocs extends Model
{
    use HasFactory;
    protected $table = 'tdocs';
    protected $primarykey = 'id';
    protected $fillable = ['title_kh', 'title_eng','dsc_kh', 'dsc_eng'];
    
}
