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
                                <th>No</th>
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
                            <?php $no=0; ?>
                            @foreach ($transaction as $item)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ $item->destination->name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->total) }}</td>
                                <td>{{ $item->status }}</td>
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