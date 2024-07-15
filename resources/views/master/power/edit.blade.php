@extends('layouts.dashboard.dashboard')

@section('title', "Edit Power")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Edit Power</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a class="breadcrumb-item" href="{{ route('dashboard.master.power.index') }}">Data</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
    </div>
</div>

{{-- content --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Edit Power</h4>
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

        <form action="{{ route('dashboard.master.power.update', $rate->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="power">Power</label>
                <input type="number" name="power" class="form-control" id="power" placeholder="Power" value="{{ $rate->power }}">
            </div>

            <div class="form-group">
                <label for="rate">Rate /kWh</label>
                <input type="number" name="rate" class="form-control" id="rate" placeholder="Rate" value="{{ $rate->rateKWH }}">
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
