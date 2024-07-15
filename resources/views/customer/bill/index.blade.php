@extends('layouts.dashboard.dashboard')

@section('title', "Bills Customer")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Bills</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <span class="breadcrumb-item active">Data</span>
        </nav>
    </div>
</div>

{{-- content --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Bills Customer</h4>
        </div>
      <div class="m-t-25">
        {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table id="data-table" class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Total Meter</th>
                    <th>Total Bill</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->user->number }} - {{ $bill->user->name }}</td>
                        <td>{{ $bill->month }}</td>
                        <td>{{ $bill->year }}</td>
                        <td>{{ number_format($bill->total_meter) }}/kWh</td>
                        <td>Rp {{ number_format($bill->total_meter * $bill->user->rate->rateKWH) }}</td>
                        <td>
                            @if ($bill->status === "Unpaid")
                                <span class="badge badge-pill badge-warning">Unpaid</span>
                            @else
                                <span class="badge badge-pill badge-success">Paid</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center" style="gap: 5px">
                                <a href="{{ route('dashboard.customer.bill.detail', $bill->id) }}">
                                    <button class="btn btn-icon btn-info btn-rounded">
                                        <i class="anticon anticon-eye"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#data-table').DataTable();
</script>
@endsection
