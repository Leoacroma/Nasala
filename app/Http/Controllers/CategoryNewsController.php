<?php

namespace App\Http\Controllers;

use App\Models\CategoryNews;
use Illuminate\Http\Request;
// use Yajra\DataTables\Contracts\DataTable;
use DataTables;

class CategoryNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsDatatable(Request $request){
       
        $data = CategoryNews::select('id', 'title_cate_kh', 'title_cate_eng', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href= '.route("admin.category.edit", $row->id).' class="btn btn-warning font-Hanuman" style="color: white;">កែប្រែ</a>';
                $btn .= '<form method="POST" action="'.route('admin.category.destroy', $row->id).'" style="margin-left: 90px; margin-top: -40px;">
                '.method_field("DELETE").'
                <input type="hidden" name="_token" value='.csrf_token().'> 
                <button type="submit"  class="btn btn-danger font-Hanuman show_confirm" style=" color: white;">លុប់ចេញ</button>
            </form>';
                return $btn;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
        return view('news-category-kh');

    }

    public function index()
    {
        return view('news-category-kh');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_categories_news.Add_categories');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title_cate_kh' => 'required',
            'title_cate_eng' => 'required',
        ]);

        CategoryNews::create([
            'title_cate_kh' => $request -> title_cate_kh,
            'title_cate_eng'=> $request -> title_cate_eng,
        ]);
        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryNews $categoryNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryNews $categoryNews, $id)
    {

        $categoryNews = CategoryNews::find($id);
        return view('Crud_categories_news.Edit_categories',compact('categoryNews'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,CategoryNews $categoryNews, $id)
    {
        $categoryNews = CategoryNews::find($id);
        $request->validate([
            'title_cate_kh' => 'required',
            'title_cate_eng' => 'required',
        ]);
       
        $categoryNews -> title_cate_kh = $request -> title_cate_kh;
        $categoryNews -> title_cate_eng = $request -> title_cate_eng;
        $categoryNews->save();
        
        return redirect()->route('admin.category.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        //
        CategoryNews::destroy($id);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.category.index');

    }
}
