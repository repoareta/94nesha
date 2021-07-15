<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// use Request
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdatePasswordRequest;

// use Model
use App\Models\User;

// use Plugin
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $Query = User::where('id','!=', 1)->get();
            return DataTables::of($Query)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '
                    <td nowrap="nowrap">
                        <a href="'. route("admin.master.users.edit", $data->id) . '" class="btn btn-clean btn-icon mr-2" title="Edit details">
                            <i class="la la-edit icon-xl"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-clean btn-icon mr-2" data-id="'.$data->id.'" title="Delete details" id="deleteUser">
                            <i class="la la-trash icon-lg"></i>
                        </a>
                    </td>
                    ';
                })
                ->make();
        }

        return view('admin.master-data.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master-data.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $Query = New User();
        $Query->name = $request->name;
        $Query->email = $request->email;
        $Query->password = Hash::make($request->password);
        $Query->save();

        Alert::success('Berhasil', 'Data berhasil disimpan')->persistent(true)->autoClose(3000);
        return redirect()->route('admin.master.users.');
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
        if($id == 1){
            return redirect()->back();
        }
        $data = User::find($id);
        return view('admin.master-data.users.edit', compact('data'));
    }

    public function editPass($id)
    {
        if($id == 1){
            return redirect()->back();
        }
        $data = User::find($id);

        return view('admin.master-data.users.edit-pass', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if($id == 1){
            return redirect()->back();
        }
        $Query = User::find($id);
        $Query->name = $request->name;
        $Query->email = $request->email;
        $Query->update();

        Alert::success('Berhasil', 'Data berhasil diupdate')->persistent(true)->autoClose(3000);
        return redirect()->route('admin.master.users.');
    }

    public function updatePass(UserUpdatePasswordRequest $request, $id)
    {
        if($id == 1){
            return redirect()->back();
        }
        $data = User::find($id);

        $cekPassLama = Hash::check($request->password_lama, $data->password);
        if(!$cekPassLama){
            Alert::error('Password Lama Tidak Sama')->persistent(true)->autoClose(3000);
            return redirect()->back();
        }

        $data->password = Hash::make($request->password_baru);
        $data->update();

        Alert::success('Update Password Berhasil')->persistent(true)->autoClose(3000);
        return redirect()->route('admin.master.users.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();

        return response()->json(['success' => true]);
    }
}
