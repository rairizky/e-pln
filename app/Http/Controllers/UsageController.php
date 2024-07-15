<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Usage;
use App\Models\User;
use Illuminate\Http\Request;

class UsageController extends Controller
{
    public function index()
    {
        $usages = Usage::all();

        return view('customer.usage.index', compact('usages'));
    }

    public function create()
    {
        $users = User::where('level_id', '=', 2)->get();

        $months = $this->months();

        $years = $this->years(5);

        return view('customer.usage.create', compact('users', 'months', 'years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'month' => 'required',
            'year' => 'required',
            'start' => 'required|integer|gte:0',
            'end' => 'required|integer|gt:start'
        ]);

        $find_usage = Usage::where('user_id', $request->get('customer'))->where('month', $request->get('month'))->where('year', $request->get('year'))->exists();

        if ($find_usage) {
            return redirect()->route('dashboard.customer.usage.create')->with('query_error', 'Usage Data Exists!');
        }

        $post = Usage::create([
            'user_id' => $request->get('customer'),
            'month' => $request->get('month'),
            'year' => $request->get('year'),
            'start_meter' => $request->get('start'),
            'end_meter' => $request->get('end')
        ]);

        if ($post) {
            return redirect()->route('dashboard.customer.usage.index')->with('success', 'Usage Data Created');
        } else {
            return back();
        }
    }

    public function make_bill($id)
    {
        $usage = Usage::find($id);

        $customer = $usage->user->id;

        $total_meter = intval($usage->end_meter) - intval($usage->start_meter);

        $find_bill = Bill::where('usage_id', $usage->id)->exists();

        if ($find_bill) {
            return redirect()->route('dashboard.customer.usage.index')->with('query_error', 'Bill Exists!');
        }

        $post = Bill::create([
            'usage_id' => $usage->id,
            'user_id' => $customer,
            'month' => $usage->month,
            'year' => $usage->year,
            'total_meter' => $total_meter,
            'status' => 'Unpaid'
        ]);

        if ($post) {
            return redirect()->route('dashboard.customer.usage.index')->with('success', 'Bill Created');
        } else {
            return back();
        }
    }

    public function edit($id)
    {
        $usage = Usage::find($id);

        $users = User::where('level_id', '=', 2)->get();

        $months = $this->months();

        $years = $this->years(5);

        return view('customer.usage.edit', compact('usage', 'users', 'months', 'years'));
    }

    public function update($id, Request $request)
    {
        $usage = Usage::find($id);

        $request->validate([
            'customer' => 'required',
            'month' => 'required',
            'year' => 'required',
            'start' => 'required|integer|gte:0',
            'end' => 'required|integer|gt:start'
        ]);

        $find_usage = Usage::where('id' ,'!=', $id)->where('user_id', $request->get('customer'))->where('month', $request->get('month'))->where('year', $request->get('year'))->exists();

        if ($find_usage) {
            return redirect()->route('dashboard.customer.usage.edit', $id)->with('query_error', 'Usage Data Exists!');
        }

        $update = $usage->update([
            'user_id' => $request->get('customer'),
            'month' => $request->get('month'),
            'year' => $request->get('year'),
            'start_meter' => $request->get('start'),
            'end_meter' => $request->get('end')
        ]);

        if ($update) {
            return redirect()->route('dashboard.customer.usage.edit', $usage->id)->with('success', 'Usage Data Updated');
        } else {
            return back();
        }
    }

    public function delete($id)
    {
        $usage = Usage::find($id);

        $delete = $usage->delete();

        if ($delete) {
            return redirect()->route('dashboard.customer.usage.index')->with('success', 'Usage Data Deleted!');
        }
    }
}
