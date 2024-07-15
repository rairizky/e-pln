@extends('layouts.dashboard.dashboard')

@section('title', "Edit Usage")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Edit Usage Data</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a class="breadcrumb-item" href="{{ route('dashboard.customer.usage.index') }}">Usage Data</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
    </div>
</div>

{{-- content --}}
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Edit Usage</h4>
        </div>
      <div class="m-t-25">
         {{-- alert success --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- alert error --}}
        @if(session('query_error'))
        <div class="alert alert-danger">
            {{ session('query_error') }}
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

        <form action="{{ route('dashboard.customer.usage.update', $usage->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="customer">Customer</label>
                <div>
                    <select class="select2" name="customer">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ strval($user->id) === strval($usage->user_id) ? 'selected' : '' }}>{{ $user->number }} - {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                         <label for="month">Month</label>
                         <div>
                            <select class="select2" name="month">
                                @foreach ($months as $month)
                                    <option value="{{ $month }}" {{ $month === $usage->month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="year">Year</label>
                        <div>
                           <select class="select2" name="year">
                               @foreach ($years as $year)
                                   <option value="{{ $year }}" {{ $year === $usage->year ? 'selected' : '' }}>{{ $year }}</option>
                               @endforeach
                           </select>
                       </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start">Start Meter</label>
                        <input type="text" name="start" class="form-control" id="start" placeholder="Start Meter" value="{{ $usage->start_meter }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end">End Meter</label>
                        <input type="text" name="end" class="form-control" id="end" placeholder="End Meter" value="{{ $usage->end_meter }}">
                    </div>
                </div>
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
