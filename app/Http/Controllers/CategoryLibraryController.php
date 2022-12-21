<?php

namespace App\Http\Controllers;

use App\Models\CategoryLibrary;
use Illuminate\Http\Request;
use DataTables;

class CategoryLibraryController extends Controller
{
    public function Datatable(){
        $data = CategoryLibrary::select('id', 'title_lib_cate_kh', 'title_lib_cate_eng', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href= '.route("admin.catelibrary.edit", $row->id).' class="btn btn-warning font-Hanuman" style="color: white;">កែប្រែ</a>';
                $btn .= '<form method="POST" action="'.route('admin.catelibrary.destroy', $row->id).'" style="margin-left: 90px; margin-top: -40px;">
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
        return view('library_category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('library_category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_lib.add-category-library');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_lib_cate_kh',
            'title_lib_cate_eng',
        ]);
        CategoryLibrary::create([
            'title_lib_cate_kh' => $request -> title_lib_cate_kh,
            'title_lib_cate_eng' => $request ->title_lib_cate_eng,
        ]);
        notify()->success('បានបញ្ចូលរួចរាល់');
        return redirect()->route('admin.catelibrary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryLibrary $categoryLibrary, $id)
    {
        //
        $categoryLibrary = CategoryLibrary::find($id);
        return view('Crud_lib.edit-category-library',compact('categoryLibrary'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,CategoryLibrary $categoryLibrary, $id)
    {
        //
        $categoryLibrary=CategoryLibrary::find($id);
        $request->validate([
            'title_lib_cate_kh' => 'required',
            'title_lib_cate_eng'=> 'required',
        ]);
        $categoryLibrary -> title_lib_cate_kh = $request -> title_lib_cate_kh;
        $categoryLibrary -> title_lib_cate_eng = $request -> title_lib_cate_eng;
        $categoryLibrary -> save();

        notify()->success('បានកែប្រែជោគជ័យ');
        return redirect()->route('admin.catelibrary.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        CategoryLibrary::destroy($id);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.catelibrary.index');       
    }
}
