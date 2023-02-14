<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use DataTables;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function akun_admin(Request $request)
    {
        if($request->ajax())
        {
            $data = User::where('role', 'admin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $confirm = "Are you sure?";
                    // btn delete
                    $actionBtn = '<a href="/administrator/'.$row->id.'/delete_akun" data-toggle="tooltip" data-confirm="Are you sure to delete this item?" data-original-title="Delete" class="btn btn-danger btn-sm deleteJalan" id="deleteJalan"><i class="fa fa-trash" style="color:white"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('auth/akun_admin');
    }

    public function delete_akun($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('view.akun')->with("status", "Akun telah berhasil dihapus");
    }

    public function register()
    {
        return view ('auth/register');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);  

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/administrator/akun_admin')->with("status", "Akun telah berhasil ditambahkan");
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]); 

        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect('/administrator')->with("status", "Anda Telah Berhasil Login");
        }

        return back()->with("error", "Username / Password Tidak Sesuai");
    }

    public function edit_password()
    {
        return view('auth/edit_password');
    }

    public function edit_password_process(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Password lama tidak sesuai!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password telah berhasil diubah");
    }

    public function sign_out()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
