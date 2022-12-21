<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        $data = News::select('id', 'title_kh', 'created_at')->limit(10)->get();
        return view('Homepage')->with('data',$data);
    }
}
