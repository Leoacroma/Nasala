<?php

namespace App\Http\Controllers;

use App\Models\CategoryNews;
use App\Models\News;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        $data = News::select('id','image',  'title_kh', 'title_eng', 'categories_id','dsc_kh', 'dsc_eng', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $button = '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle font-Hanuman-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear" style="font-size: 13px;"></i>    
                        ការកំណត់
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item font-Hanuman-bold" href= '.route("admin.news.edit", $row->id).'>
                                <i class="fa-solid fa-pen-to-square mr-2"></i> កែប្រែ
                            </a></li>
                        <li><form method="POST" action="'.route('admin.news.destroy', $row->id).'"   >
                             '.method_field("DELETE").'
                             <input type="hidden" name="_token" value='.csrf_token().'>
                             <button type="submit"  class="dropdown-item font-Hanuman-bold show_confirm">
                                <i class="fa-solid fa-trash"></i> លុប់ចេញ
                             </button>
                         </form></li>
                        <li><a href= '.route("admin.news.show", $row->id).' class="dropdown-item font-Hanuman-bold">
                        <i class="fa-solid fa-eye"></i> មើល
                        </a></li>
                    </ul>
                </div>

                ';
                return $button;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
    
            ->addColumn('title_cate_kh',function($data){
                return $data->category->title_cate_kh;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action', 'dsc_kh', 'dsc_eng'])
            ->make(true);
        return view('news-kh');
    }

    public function index()
    {
        $news = News::all();
        return view('news-kh')->with('new', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate = CategoryNews::all();
        return view('Crud_News.add_news', ['cate' => $cate]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestnction
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_kh' => 'required',
            'title_eng'=> 'required',
            'categories_id' => 'required',
            'dsc_kh' => 'required',
            'dsc_eng' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $img_image = request() -> image -> getClientOriginalName();
        request()->image->move(public_path('uploads/image'),$img_image);
        News::create([
            'title_kh' => $request -> title_kh,
            'title_eng' => $request -> title_eng,
            'categories_id' => $request -> categories_id,
            'dsc_kh' => $request -> dsc_kh,
            'dsc_eng' => $request -> dsc_eng,
            'image' => $img_image,
        ]);
        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.news.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news, $id)
    {
        //
        $news = News::find($id);
        return view('Crud_News.preview_news',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = CategoryNews::all();
        $news = News::find($id);
        return view('Crud_News.edit_news',)->with('news', $news)->with('cate',$cate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news, $id)
    {
        //
        $news = News::find($id);
        $request->validate([
            'title_kh' => 'required',
            'title_eng'=> 'required',
            'dsc_kh' => 'required',
            'dsc_eng' => 'required',
            'image' => 'required',
            'categories_id' => 'required',
        ]);
        $input = $request->all();

        if ($image = $request->file('image')){

            $destinationPath = 'uploads/image';
            $NewsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $NewsImage);
            $input['image'] = "$NewsImage";
        }else{
            unset($input['image']);
        }

        $news->update($input);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, $id)
    {
        //
        News::destroy($id);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.news.index');

    }
}
