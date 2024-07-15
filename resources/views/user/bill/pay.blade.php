@extends('layouts.dashboard.dashboard')

@section('title', "Pay Bill")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Bills</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a class="breadcrumb-item" href="{{ route('dashboard.user.bill.index') }}">Data</a>
            <span class="breadcrumb-item active">Pay</span>
        </nav>
    </div>
</div>

{{-- content --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Bills Summary</h4>
            @if ($bill->status !== "Unpaid")
                <span>Paid : {{ $bill->payment->datetime }}</span>
            @else
                <form action="{{ route('dashboard.user.bill.paid', $bill->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Pay</button>
                </form>
            @endif
        </div>
      <div class="m-t-25">
        {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="row m-t-20 lh-2">
            <div class="col-sm-9">
                <div class="m-t-10">
                    <span class="font-weight-semibold text-dark">Bill {{ $bill->user->number }}</span><br>
                    <span>{{ $bill->user->name }}</span><br>
                    <span>{{ $bill->user->address }}</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="m-t-10">
                    <div class="text-dark d-inline-block">
                        <span class="font-weight-semibold text-dark">Month :</span>
                    </div>
                    <div class="float-right">{{ $bill->month }} {{ $bill->year }}</div>
                </div>
                <div class="text-dark d-inline-block">
                    <span class="font-weight-semibold text-dark">Status :</span>
                </div>
                <div class="float-right">{{ $bill->status }}</div>
            </div>
        </div>
        <div class="m-t-20">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>{{ $bill->total_meter }}/kWh</td>
                            <td align="right">Rp {{ number_format($bill->total_meter * $bill->user->rate->rateKWH) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row m-t-30 lh-1-8">
                <div class="col-sm-12">
                    <div class="float-right text-right">
                        <p>Sub - Total amount: Rp {{ number_format($bill->total_meter * $bill->user->rate->rateKWH) }}</p>
                        <p>Admin Charge : Rp {{ number_format(2500) }} </p>
                        <hr>
                        <h3><span class="font-weight-semibold text-dark">Total :</span> Rp {{ number_format(($bill->total_meter * $bill->user->rate->rateKWH) + 2500) }}</h3>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

