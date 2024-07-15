<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('level_id', '=', '2')->get();

        return view('customer.data.index', compact('customers'));
    }

    public function create()
    {
        $rates = Rate::all();

        return view('customer.data.create', compact('rates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'number' => 'required|numeric|unique:users,number',
            'address' => 'required',
            'rate' => 'required'
        ]);

        $level = Level::where('name', '=', 'user')->first();

        $password_format = strtolower($request->get('username') . '123');

        $post = User::create([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($password_format),
            'number' => $request->get('number'),
            'address' => $request->get('address'),
            'rate_id' => $request->get('rate'),
            'level_id' => $level->id
        ]);

        if ($post) {
            return redirect()->route('dashboard.customer.data.index')->with('success', 'Customer Data Created');
        } else {
            return back();
        }
    }

    public function edit($id)
    {
        $customer = User::find($id);

        $rates = Rate::all();

        return view('customer.data.edit', compact('customer', 'rates'));
    }

    public function update($id, Request $request)
    {
        $customer = User::find($id);

        $request->validate([
            'name' => 'required',
            'username' => "required|unique:users,username,$id",
            'email' => "required|email|unique:users,email,$id",
            'number' => "required|numeric|unique:users,number,$id",
            'address' => 'required',
            'rate' => 'required'
        ]);

        $update = $customer->update([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'number' => $request->get('number'),
            'address' => $request->get('address'),
            'rate_id' => $request->get('rate'),
        ]);

        if ($update) {
            return redirect()->route('dashboard.customer.data.edit', $customer->id)->with('success', 'Customer Data Updated!');
        } else {
            return back();
        }
    }

    public function delete($id)
    {
        $customer = User::find($id);

        $delete = $customer->delete();

        if ($delete) {
            return redirect()->route('dashboard.customer.data.index')->with('success', 'Customer Data Deleted!');
        }
    }
}
