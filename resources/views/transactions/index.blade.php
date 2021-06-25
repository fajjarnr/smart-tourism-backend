@extends('layouts.app')

@section('title')
Transaksi
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                List Data Transaksi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Destination</th>
                                <th>User</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->destinations->name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->total) }}</td>
                                <td>
                                    @if ($item->status == 'SUCCESS')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                    @else
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center row align-items-center">
                                    <a href="{{route('transactions.show', $item->id)}}" class="btn btn-primary mx-1"><i
                                            class="fa fa-eye"></i></a>
                                    <form action="{{route('transactions.destroy', $item->id)}}" method="post">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endpush