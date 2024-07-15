<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class PowerController extends Controller
{
    public function index() {
        $rates = Rate::all();

        return view('master.power.index', compact('rates'));
    }

    public function create()
    {
        return view('master.power.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'power' => 'required|integer',
            'rate' => 'required|integer'
        ]);

        $post = Rate::create([
            'power' => $request->get('power'),
            'rateKWH' => $request->get('rate')
        ]);

        if ($post) {
            return redirect()->route('dashboard.master.power.index')->with('success', 'Power Data Created');
        } else {
            return back();
        }
    }

    public function edit($id)
    {
        $rate = Rate::find($id);

        return view('master.power.edit', compact('rate'));
    }

    public function update($id, Request $request)
    {
        $rate = Rate::find($id);

        $request->validate([
            'power' => 'required|integer',
            'rate' => 'required|integer'
        ]);

        $update = $rate->update([
            'power' => $request->get('power'),
            'rateKWH' => $request->get('rate')
        ]);

        if ($update) {
            return redirect()->route('dashboard.master.power.edit', $rate->id)->with('success', 'Power Data Updated');
        } else {
            return back();
        }
    }

    public function delete($id)
    {
        $rate = Rate::find($id);

        $delete = $rate->delete();

        if ($delete) {
            return redirect()->route('dashboard.master.power.index')->with('success', 'Power Data Deleted!');
        }
    }
}
