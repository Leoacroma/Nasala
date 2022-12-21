<?php

namespace App\Http\Controllers;

use App\Models\Tplan;
use Illuminate\Http\Request;
use DataTables;
class TplanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newsDatatable(Request $request){
       
        $data = Tplan::select('id', 'title_kh', 'title_eng', 'created_at');
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href= '.route("admin.tplan.edit", $row->id).' class="btn btn-warning font-Hanuman" style="color: white;">កែប្រែ</a>';
                $btn .= '<form method="POST" action="'.route('admin.tplan.destroy', $row->id).'" style="margin-left: 90px; margin-top: -40px;">
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
        return view('training-tplan');

    }


    public function index()
    {
        //
        return view('training-tplan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Crud_tplan.Add-tplan');
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
            'title_eng' => 'required',
        ]);
        
        Tplan::create([
            'title_kh' => $request -> title_kh,
            'title_eng' => $request -> title_eng,
        ]);

        notify()->success('បានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.tplan.index');
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
    public function edit(Tplan $tplan, $id)
    {
        //
        $tplan = Tplan::find($id);
        return view('Crud_tplan.edit-tplan', compact('tplan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tplan = Tplan::find($id);
        $request -> validate([
            'title_kh' => 'required',
            'title_eng' => 'required',
        ]);

        $tplan -> title_kh = $request -> title_kh;
        $tplan -> title_eng = $request -> title_eng;
        $tplan->save();
        
        notify()->success('កែប្រែបានបញ្ចូលជោគជ័យ');
        return redirect()->route('admin.tplan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Tplan $tplan 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tplan::destroy($id);
        notify()->success('បានលុបជោគជ័យ');
        return redirect()->route('admin.tplan.index');
    }
}
