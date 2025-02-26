<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    //
    public function index()
    {
        // $users = DB::table('users')->get();
        $users = User::all();

        return view('users', compact('users'));
    }

    public function create()
    {
        $user_name = $_POST['name'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        // DB::table('users')->insert(['name' => $user_name, 'email' => $user_email, 'password' => $user_password]);
        $user = new User;
        $user->name = $user_name;
        $user->email = $user_email;
        $user->password =  $user_password;
        $user->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        // DB::table('users')->where('id', '=', $id)->delete();
        User::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        // $user = DB::table('users')->where('id', $id)->first();
        $user = User::find($id);
        // $users = DB::table('users')->get();
        $users = User::all();
        return view('users', compact('user', 'users'));
    }

    public function update()
    {
        $id = $_POST['id'];
        // DB::table('users')->where('id', $id)->update(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
        User::where('id', $id)->update(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
        return redirect('users');
    }
}
