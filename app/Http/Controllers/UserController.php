<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function datatable(){
        $data = User::select('id','name',  'email', 'password','created_at');
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
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
        return view('user');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
