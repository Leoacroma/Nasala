<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DataTables;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primarykey = 'id';
    protected $fillable = [
        'title_kh',
        'title_eng', 
        'categories_id',
        'image',
        'dsc_kh',
        'dsc_eng',
    ];
    public function showDate(){
        return $this->created_at->diffForHumans();
    }
    public function category(){
        return $this->belongsTo(CategoryNews::class, 'categories_id');
    } 
}
