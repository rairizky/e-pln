@extends('layouts.dashboard.dashboard')

@section('title', "Edit Customer")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Edit Customer</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a class="breadcrumb-item" href="{{ route('dashboard.customer.data.index') }}">Data</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
    </div>
</div>

{{-- content --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Edit Customer</h4>
        </div>
      <div class="m-t-25">
        {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

       {{-- errors alert --}}
       @if ($errors->any())
       <div class="alert alert-danger">
           <ul style="padding-left: 12px;">
               @foreach($errors->all() as $err)
                   <li>{{ $err }}</li>
               @endforeach
           </ul>
       </div>
        @endif

        <form action="{{ route('dashboard.customer.data.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $customer->name }}">
            </div>

            <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ $customer->username }}">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $customer->email }}">
                    </div>
               </div>
            </div>

            <div class="form-group">
                <label for="number">Number</label>
                <input type="text" name="number" class="form-control" id="number" placeholder="Number" value="{{ $customer->number }}">
            </div>

            <div class="form-group">
                <label for="rate">Rate</label>
                <div>
                    <select class="select2" name="rate">
                        @foreach ($rates as $rate)
                            <option value="{{ $rate->id }}" {{ strval($rate->id) === strval($customer->rate_id) ? 'selected' : '' }}>{{ $rate->power }} - Rp {{ number_format($rate->rateKWH) }}/kWh</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ $customer->address }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.select2').select2();
</script>
@endsection
