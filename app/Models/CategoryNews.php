<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasFactory;
    protected $table = 'news_categories';
    protected $primarykey = 'id';
    protected $fillable = ['title_cate_kh', 'title_cate_eng'];
    
    public function todaydate(){
        return $this->created_at->diffForHumans();
    }
}
