<?php

namespace App\Http\Controllers;

use App\Models\CategoryLibrary;
use App\Models\Library;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function Datatables()
    {
        $data = Library::select('id','title_kh',  'title_eng', 'cate_id', 'file', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $button = '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle font-Hanuman-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear" style="font-size: 13px;"></i>    
                        ការកំណត់
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item font-Hanuman-bold" href= '.route("admin.library.edit", $row->id).'>
                                <i class="fa-solid fa-pen-to-square mr-2"></i> កែប្រែ
                            </a></li>
                        <li><form method="POST" action="'.route('admin.tplan.destroy', $row->id).'"   >
                             '.method_field("DELETE").'
                             <input type="hidden" name="_token" value='.csrf_token().'>
                             <button type="submit"  class="dropdown-item font-Hanuman-bold show_confirm">
                                <i class="fa-solid fa-trash"></i> លុប់ចេញ
                             </button>
                         </form></li>
                        <li><a href= '.route("admin.library.download", $row->file).' class="dropdown-item font-Hanuman-bold">
                        <i class="fa-solid fa-cloud-arrow-down"></i> ទាញយក
                        </a></li>
                    </ul>
                </div>

                ';
                return $button;

            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->addColumn('title_lib_cate_kh', function($data){
                return $data->categories->title_lib_cate_kh;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
        return view('library');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('library');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //
        $categorylibrary = CategoryLibrary::all();
        return view('Crud_library.add_library')->with('catelibrary', $categorylibrary);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'title_kh' => 'required',
            'title_eng'=> 'required',
            'cate_id' => 'required',
            'file' => 'required'
        ]);
        $file = request() -> file ->getClientOriginalName();
        $destination = storage_path('uploads/PDf/');
        request() -> file -> move($destination,$file);
    
        Library::create([
            'title_kh' => $request -> title_kh,
            'title_eng'=> $request -> title_eng,
            'cate_id' => $request -> cate_id,
            'file'=> $file,            
        ]);
        notify()->success('បានបញ្ចូលរួចរាល');
        return redirect()->route('admin.library.index');

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
    public function edit($id)
    {
        //
        $categorylibrary = CategoryLibrary::all();
        $lib = Library::find($id);
        return view('Crud_library.edit_library')->with('lib', $lib)->with('categorylibrary',$categorylibrary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Library $library, $id)
    {
        //
        $library = Library::find($id);
        $request -> validate([
            'title_kh' => 'required',
            'title_eng' => 'required',
            'cate_id' => 'required',
            'file' => 'required',
        ]);
        $input = $request -> all();
        if ($filename = $request->file('file')){

            $destinationPath = 'uploads/PDf';
            $NewsFile = date('YmdHis') . "." . $filename->getClientOriginalExtension();
            $filename->move($destinationPath, $NewsFile);
            $input['file'] = "$NewsFile";
        }else{
            unset($input['file']);
        }
        $library->update($input);
        notify()->success('បានផ្លាសប្តូររួចរាល់');
        return redirect()->route('admin.library.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Library::destroy($id);
        return redirect()->route('admin.library.index');
    }
    public function download($file)
    {
       $path = storage_path('uploads/PDf/'.$file);
       return response()->download($path);
    }
}
