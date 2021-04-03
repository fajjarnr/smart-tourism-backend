@extends('layouts.app')

@section('title')
Data Destinasi
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                List Data Destinasi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Price</th>
                                <th>Hours</th>
                                <th>Facilities</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; ?>
                            @foreach ($location as $item)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->phoneNumber}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->hours}}</td>
                                <td>{{$item->facilities}}</td>
                                <td>{{$item->category->name}}</td>
                                <td><img src="{{asset('')}}" width="30px" height="30px">
                                </td>
                                <td class="text-center row align-items-center">
                                    <a href="{{route('location.edit', $item->id)}}" class="btn btn-primary mx-1"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{route('location.destroy', $item->id)}}" method="post">
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