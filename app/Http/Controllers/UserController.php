<?php

namespace App\Http\Controllers;

use App\Models\loginActivity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekap = new loginActivity();
        return view('admin.operator.operator',[
            'title'=>'List Operator',
            'operator'=>User::where('role_id','!=',1)->Operator(request('search'))->latest()->get(),
            'login'=>$rekap->rekapLogin(1)->Rekap(request('search'))->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.operator.create',[
            'title'=>'Tambah Operator',
            'role'=>Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'username'=>['required','unique:users,username'],
            'role_id'=>'required',
            'password'=>['required','min:8']
        ]);
        $pass =  Hash::make($validate['password']);
        $validate['password'] = $pass;
// dd($validate);
        User::create($validate);
        notify()->success('Berhasil menambah operator','Tambah Operator');
        return redirect()->route('management.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $management)
    {
        return view('admin.operator.edit',[
            'title'=>'Edit Operator',
            'operator'=>$management,
            'role'=>Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $management)
    {
        $validate = $request->validate([
            'nama'=>'required',
            'username'=>'required',
            'role_id'=>'required',
            'password'=>''
        ]);
        if($request->filled('password')){
            $pass =  Hash::make($validate['password']);
        $validate['password'] = $pass;
        }else{
        $validate['password'] = $management->password;

        }
        $management->update($validate);
        notify()->success('Berhasil mengubah data operator','Edit Operator');
        return redirect()->route('management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $management)
    {
        $management->delete();
        return back();
    }
}
