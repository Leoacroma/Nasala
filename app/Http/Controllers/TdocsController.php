<?php

namespace App\Http\Controllers;

use App\Models\Tdocs;
use Illuminate\Http\Request;
use DataTables;
class TdocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsDatatable(Request $request){
       
        $data = Tdocs::select('id', 'title_kh', 'title_eng', 'dsc_kh', 'dsc_eng','created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href= '.route("admin.tdocs.edit", $row->id).' class="btn btn-warning font-Hanuman" style="color: white;">កែប្រែ</a>';
                $btn .= '<form method="POST" action="'.route('admin.tdocs.destroy', $row->id).'" style="margin-left: 90px; margin-top: -40px;">
                '.method_field("DELETE").'
                <input type="hidden" name="_token" value='.csrf_token().'> 
                <button type="submit"  class="btn btn-danger show_confirm font-Hanuman" style=" color: white;">លុប់ចេញ</button>
            </form>';
                return $btn;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->diffForHumans();
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action','dsc_kh','dsc_eng'])
            ->make(true);
        return view('training-tplan');

    }



    public function index()
    {
        //
        return view('training-tdocs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_tdocs.add_tdocs');
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
            'title_kh'  => 'required',
            'title_eng' => 'required',
            'dsc_kh'    => 'required',
            'dsc_eng'   => 'required',

        ]);
        Tdocs::create([
            'title_kh' => $request -> title_kh,
            'title_eng'=> $request -> title_eng,
            'dsc_kh'   => $request -> dsc_kh,
            'dsc_eng'  => $request -> dsc_eng,
        ]);
        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.tdocs.index');
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
    public function edit(Tdocs $tdocs, $id)
    {
        //
        $tdocs = Tdocs::find($id);
        return view('Crud_tdocs.edit_tdocs',compact('tdocs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request -> validate([
            'title_kh'  => 'required',
            'title_eng' => 'required',
            'dsc_kh'    => 'required',
            'dsc_eng'   => 'required',
        ]);
        Tdocs::create([
            'title_kh' => $request -> title_kh,
            'title_eng'=> $request -> title_eng,
            'dsc_kh' => $request -> dsc_kh,
            'dsc_eng' => $request-> dsc_eng,
        ]);
        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.tdocs.index');
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
        Tdocs::destroy($id);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.tdocs.index');
    }
}
