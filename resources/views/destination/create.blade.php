@extends('layouts.app')

@section('title')
Create Destination
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endpush

@section('content')
<div class="col-12">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-body">

                @if ($errors->any())
                <div class="mb-5" role="alert">
                    <div class="alert alert-danger dark alert-dismissible fade show" role="alert"><strong>There's
                            something wrong!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                </div>
                @endif

                <form action="{{ route('destination.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">

                    @csrf

                    <div class="col mb-3">
                        <label for="validationCustom01">Latitude</label>
                        <input value="{{ old('latitude') }}" name="latitude" class="form-control"
                            id="validationCustom01" type="text" placeholder="latitude" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Longitude</label>
                        <input value="{{ old('longitude') }}" name="longitude" class="form-control"
                            id="validationCustom01" type="text" placeholder="longitude" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Nama</label>
                        <input value="{{ old('name') }}" name="name" class="form-control" id="validationCustom01"
                            type="text" placeholder="name" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="floatingTextarea2">Description</label>
                        <textarea value="{{ old('description') }}" name="description" class="form-control"
                            placeholder="description" id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>

                    <div class="col mb-3">
                        <div class="col-form-label">Category</div>
                        <select name="category_id" class="js-example-basic-single col">
                            <option value="">Select a Category</option>
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Alamat</label>
                        <input value="{{ old('address') }}" name="address" class="form-control" id="validationCustom01"
                            type="text" placeholder="address" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Rating</label>
                        <input value="{{ old('rate') }}" name="rate" class="form-control" id="validationCustom01"
                            type="number" max="5" min="1" placeholder="rate" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Nomor Telepon</label>
                        <input value="{{ old('phoneNumber') }}" name="phoneNumber" class="form-control"
                            id="validationCustom01" type="text" placeholder="phoneNumber" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Harga Tiket</label>
                        <input value="{{ old('price') }}" name="price" class="form-control" id="validationCustom01"
                            type="text" placeholder="price" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Jam Buka</label>
                        <input value="{{ old('hours') }}" name="hours" class="form-control" id="validationCustom01"
                            type="text" placeholder="hours" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Fasilitas</label>
                        <input value="{{ old('facilities') }}" name="facilities" class="form-control"
                            id="validationCustom01" type="text" placeholder="facilities" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Tipe</label>
                        <input value="{{ old('types') }}" name="types" class="form-control" id="validationCustom01"
                            type="text" placeholder="types" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input name="picturePath" class="form-control" type="file" id="formFile">
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endpush