<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;
use DataTables;

class ScholarController extends Controller
{
    public function Datatable(){
        $data = Scholarship::select('id','title_kh',  'title_eng', 'dsc_kh','dsc_eng', 'file', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $button = '
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle font-Hanuman-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear" style="font-size: 13px;"></i>    
                        ការកំណត់
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item font-Hanuman-bold" href= '.route("admin.scholarship.edit", $row->id).'>
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
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action', 'dsc_kh', 'dsc_eng'])
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
        return view('Scholarship');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_scholarship.add_scholarship');
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
        $request -> validate([
            'title_kh' => 'required',
            'title_eng'=> 'required',
            'dsc_eng' => 'required',
            'dsc_kh' => 'required',
            'file' => 'required',
        ]);
        $file = request()->file -> getClientOriginalName();
        $destination = storage_path('uploads/PDf');
        request()-> file -> move($destination);

        Scholarship::create([
            'title_kh' => $request -> title_kh,
            'title_eng'=> $request -> title_eng,
            'dsc_eng' => $request -> dsc_eng,
            'dsc_kh' => $request -> dsc_kh,
            'file' => $file,
        ]);
        notify()->success('បញ្ចូលជោគជ័យ');
        return redirect()->route('admin.scholarship.index');

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
        $scholar = Scholarship::find($id);
        return view('Crud_scholarship.edit_scholarship', compact('scholar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Scholarship $scholarship,$id)
    {
        $scholarship = Scholarship::find($id);
        $request -> validate([
            'title_kh' => 'required',
            'title_eng' => 'required',
            'file' => 'required',
            'dsc_kh' => 'required',
            'dsc_eng'=> 'required',
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
        $scholarship->update($input);
        notify()->success('បានផ្លាសប្តូររួចរាល់');
        return redirect()->route('admin.scholarship.index');
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
    }
}
