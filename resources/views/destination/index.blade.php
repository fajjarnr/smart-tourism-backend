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
                <a href="{{ route('destination.create') }}" class="btn btn-primary"><i data-feather="plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Harga Tiket</th>
                                <th>Jam Operasional</th>
                                <th>Fasilitas</th>
                                <th>Kategori</th>
                                <th>Tipe</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=0; ?>
                            @foreach ($destination as $item)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{Str::limit($item->description, 10)}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->hours}} jam</td>
                                <td>{{$item->facilities}}</td>
                                <td>{{$item->category->name ?? '-'}}</td>
                                <td>{{$item->types}}</td>
                                <td><img src="{{asset($item->image)}}" width="50px"></td>
                                </td>
                                <td class="text-center row align-items-center">
                                    {{-- <a href="{{route('destination.edit', $item->id)}}" class="btn btn-primary
                                    mx-1"><i class="fa fa-edit"></i></a> --}}
                                    <form action="{{route('destination.destroy', $item->id)}}" method="post">
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