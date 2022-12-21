<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'library';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_kh',
        'title_eng',
        'cate_id',
        'file',
        'size',
    ];
    public function categories(){
        return $this->belongsTo(CategoryLibrary::class, 'cate_id');
    }

}
