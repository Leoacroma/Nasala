<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLibrary extends Model
{
    use HasFactory;
    protected $table = 'category_library';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_lib_cate_kh',
        'title_lib_cate_eng',
    ];
}
