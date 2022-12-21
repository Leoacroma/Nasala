<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;
use DataTables;

class EnrollController extends Controller
{
    public function datatable(){
        $data = Enroll::select('id','title_enroll_kh',  'title_enroll_eng','dsc_en_kh', 'dsc_en_eng', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href= '.route("admin.enroll.edit", $row->id).' class="btn btn-warning font-Hanuman" style="color: white;">កែប្រែ</a>';
                $btn .= '<form method="POST" action="'.route('admin.enroll.destroy', $row->id).'" style="margin-left: 90px; margin-top: -40px;">
                '.method_field("DELETE").'
                <input type="hidden" name="_token" value='.csrf_token().'>
                <button type="submit"  class="btn btn-danger font-Hanuman show_confirm" style="color: white;">លុប់ចេញ</button>
            </form>';
                return $btn;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action', 'dsc_en_kh', 'dsc_en_eng'])
            ->make(true);
        return view('training-enroll');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('training-enroll');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_Enroll.add_enroll');
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
            'title_enroll_kh' => 'required',
            'title_enroll_eng'=> 'required',
            'dsc_en_kh' => 'required',
            'dsc_en_eng'=> 'required',
        ]);
        Enroll::create([
            'title_enroll_kh' => $request -> title_enroll_kh,
            'title_enroll_eng'=> $request -> title_enroll_eng,
            'dsc_en_kh' => $request -> dsc_en_kh,
            'dsc_en_eng' => $request -> dsc_en_eng,
        ]);

        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.enroll.index');
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
    public function edit(Enroll $enroll, $id)
    {
        //
        $enroll = Enroll::find($id);
        return view('Crud_Enroll.edit_enroll', compact('enroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enroll $enroll, $id)
    {
        //
        $enroll = Enroll::find($id);
        $request->validate([
            'title_enroll_kh' => 'required',
            'title_enroll_eng'=> 'required',
            'dsc_en_kh' => 'required',
            'dsc_en_eng'=> 'required',
        ]);

        $enroll -> title_enroll_kh = $request -> title_enroll_kh;
        $enroll -> title_enroll_eng = $request -> title_enroll_eng;
        $enroll -> dsc_en_kh = $request -> dsc_en_kh;
        $enroll -> dsc_en_eng = $request -> dsc_en_eng;
        $enroll -> save();

        notify()->success('កែប្រែជោគជ័យ');
        return redirect()-> route('admin.enroll.index');
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
        Enroll::destroy($id);
        notify()->success('លុប់ជោកជ័យ');
        return redirect()->route('admin.enroll.index');
    }
}
