@extends('layouts.app')

@section('title')
Users
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
            <div class="row">
                <i data-feather="bell" class="ml-3 mr-3"></i>
                <p>Pastikan menghapus data transaksi terlebih dahulu sebelum menghapus data pengguna</p>
            </div>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; ?>
                            @foreach ($users as $user)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->city}}</td>
                                <td>
                                    @if ($user->roles == 'admin')
                                    <span class="badge bg-success">{{$user->roles}}</span>
                                    @else
                                    <span class="badge bg-warning">{{$user->roles}}</span>
                                    @endif
                                </td>
                                <td class="text-right row mx-2">
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i></a>
                                    <form action="{{route('users.destroy', $user->id)}}" method="post">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i></button>
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