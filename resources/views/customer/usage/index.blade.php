@extends('layouts.dashboard.dashboard')

@section('title', "Usage")

@section('content')
{{-- breadcrumb --}}
<div class="page-header">
    <h2 class="header-title">Usage</h2>
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
            <h4>Usage Data</h4>
            <a href="{{ route('dashboard.customer.usage.create') }}">
                <button class="btn btn-primary">Add Usage Data</button>
            </a>
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

        <table id="data-table" class="table">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Start Meter</th>
                    <th>End Meter</th>
                    <th style="width: 200px !important;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usages as $usage)
                    <tr>
                        <td>{{ $usage->user->number }} - {{ $usage->user->name }}</td>
                        <td>{{ $usage->month }}</td>
                        <td>{{ $usage->year }}</td>
                        <td>{{ $usage->start_meter }}</td>
                        <td>{{ $usage->end_meter }}</td>
                        <td>
                            <div class="d-flex justify-content-center" style="gap: 5px">
                                <form action="{{ route('dashboard.customer.usage.make_bill', $usage->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-icon btn-info btn-rounded">
                                        <i class="anticon anticon-dollar"></i>
                                    </button>
                                </form>
                                <a href="{{ route('dashboard.customer.usage.edit', $usage->id) }}">
                                    <button class="btn btn-icon btn-warning btn-rounded">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                </a>
                                <button class="btn btn-icon btn-danger btn-rounded" data-toggle="modal" data-target="#modalDelete{{ $usage->id }}">
                                    <i class="anticon anticon-delete"></i>
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalDelete{{ $usage->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <i class="anticon anticon-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure want to delete this data?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                            <form action="{{ route('dashboard.customer.usage.delete', $usage->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
