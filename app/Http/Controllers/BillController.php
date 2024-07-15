<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index() {
        $bills = Bill::all();

        return view('customer.bill.index', compact('bills'));
    }

    public function detail($id) {
        $bill = Bill::find($id);

        return view('customer.bill.detail', compact('bill'));
    }

    public function user_index() {
        $bills = Bill::where('user_id', Auth::user()->id)->get();

        return view('user.bill.index', compact('bills'));
    }

    public function pay_bill($id) {
        $bill = Bill::find($id);

        return view('user.bill.pay', compact('bill'));
    }

    public function paid_bill($id) {
        $bill = Bill::find($id);

        $post = Payment::create([
            'bill_id' => $bill->id,
            'user_id' => $bill->user->id,
            'datetime' => Carbon::now(),
            'admin_charge' => 2500,
            'total_payment' => ($bill->total_meter * $bill->user->rate->rateKWH) + 2500
        ]);

        if ($post) {
            $bill->update([
                'status' => 'Paid'
            ]);

            return redirect()->route('dashboard.user.bill.pay', $bill->id)->with('success', 'Payment Success!');
        } else {
            return back();
        }
    }
}
