<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
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

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email:rfc,dns',
            'password' => ['required', 'confirmed', Password::min(8)->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ]);

        // DB::table('users')->insert(['name' => $user_name, 'email' => $user_email, 'password' => $user_password]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Encrypt the password
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email:rfc,dns',
            'password' => ['required', 'confirmed', Password::min(8)->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ]);

        $id = $request->id;
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) // Encrypt the password
        ]);

        return redirect('users');
    }
}
