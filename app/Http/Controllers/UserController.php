<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Charts\TanggapanChart;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function showLogin()
    {
        return view('login.index');
    }


    public function showRegister()
    {
        return view('login.register');
    }

    public function chart(TanggapanChart $chart)
    {
        return view('user.chart', ['chart' => $chart->build()]);
    }

    public function register(Request $request)
    {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:100',
                'password' => 'required|min:5',
                'role' => 'required|min:3',
            ],
            [
                'name.required' => 'Nama Harus Diisi',
                'email.required' => 'Email Harus Diisi',
                'password.required' => 'Password Harus Diisi',
                'role.required' => 'Role Harus Diisi',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            $login = $request->only(['email', 'password']);
            if (Auth::attempt($login)) {
                return redirect()->route('report.data')->with('success', 'Your Account Has Been Added Successfully!');
            } else {
                return redirect()->back()->with('failed', 'Account Creation Failed');
            }
        }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $login = $request->only(['email', 'password']);
        if (Auth::attempt($login)) {
            if (Auth::user()->role == 'staff') {
                return redirect()->route('response.data')->with('success', 'You Login Successfully!');
            } elseif (Auth::user()->role == 'head_staff') {
                return redirect()->route('user.chart')->with('success', 'You Login Successfully!');
            } else {
                return redirect()->route('report.monitor')->with('success', 'You Login Successfully!');
            }
        } else {
            return redirect()->back()->with('failed', 'Login Was failed');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You Logout Successfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:100',
            'password' => 'required|min:5',
            'role' => 'required|min:3',
        ],
        [
            'name.required' => 'Nama Harus Diisi',
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'role.required' => 'Role Harus Diisi',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('user.table')->with('success', 'User created successfully!');
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
        $userId = User::where('id', $id)->first();;
        return view('user.edit', compact('userId'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('user.table')->with('success', 'Berhasil Mengedit Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        // Perform the deletion
        $user->delete();
        // Redirect back with a success message
        return redirect()->route('user.table')->with('success', 'user deleted successfully!');
    }
}
