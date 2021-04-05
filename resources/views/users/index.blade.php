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
        <div class="card">
            <div class="card-header">
                <a href="{{ route('users.create') }}" class="btn btn-primary"><i data-feather="user-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Profile Photo</th>
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
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->roles == 'admin')
                                    <span class="badge bg-success">{{$user->roles}}</span>
                                    @else
                                    <span class="badge bg-warning">{{$user->roles}}</span>
                                    @endif
                                </td>
                                <td><img src="{{asset('storage/assets/user'.$user->profile_photo_path)}}"
                                        alt="photo profile" width="30px" height="30px">
                                </td>
                                <td class="text-center row align-items-center">
                                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary mx-1"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{route('users.destroy', $user->id)}}" method="post">
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