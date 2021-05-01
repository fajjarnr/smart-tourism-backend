@extends('layouts.app')

@section('title')
Banner
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}" />
@endpush

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('banner.create') }}" class="btn btn-primary"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>image</th>
                                <th>Destination</th>
                                <th>Berita</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; ?>
                            @foreach ($banner as $item)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td><img src="{{asset('storage/assets/banner'.$item->image)}}" alt="photo profile"
                                        width="30px" height="30px">
                                </td>
                                {{-- <td>{{$item->destination->id}}</td> --}}
                                <td>destinasi</td>
                                <td>berita</td>
                                <td class="text-center row align-items-center">
                                    <a href="{{route('banner.edit', $item->id)}}" class="btn btn-primary mx-1"><i
                                            class="fa fa-edit"></i></a>
                                    <form action="{{route('banner.destroy', $item->id)}}" method="post">
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