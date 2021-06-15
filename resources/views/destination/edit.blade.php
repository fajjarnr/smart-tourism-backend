@extends('layouts.app')

@section('title')
Edit Destination
@endsection

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

                <form action="{{ route('destination.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">

                    @csrf
                    @method('PUT')

                    <div class="col mb-3">
                        <label for="validationCustom01">Latitude</label>
                        <input value="{{ old('latitude') ?? $item->latitude }}" name="latitude" class="form-control"
                            id="validationCustom01" type="text" placeholder="latitude" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Longitude</label>
                        <input value="{{ old('longitude') ?? $item->longitude }}" name="longitude" class="form-control"
                            id="validationCustom01" type="text" placeholder="longitude" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Nama</label>
                        <input value="{{ old('name') ?? $item->name }}" name="name" class="form-control"
                            id="validationCustom01" type="text" placeholder="name" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="form-group">
                        <div class="col-form-label">Category</div>
                        <select wire:model="category" name="category_id" class="js-example-basic-single col">
                            <option value="">Select a Category</option>
                            @foreach ($item as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Alamat</label>
                        <input value="{{ old('address') ?? $item->address }}" name="address" class="form-control"
                            id="validationCustom01" type="text" placeholder="address" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Rating</label>
                        <input value="{{ old('rate') ?? $item->rate }}" name="rate" class="form-control"
                            id="validationCustom01" type="number" max="5" min="1" placeholder="rate" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Nomor Telepon</label>
                        <input value="{{ old('phoneNumber') ?? $item->phoneNumber }}" name="phoneNumber"
                            class="form-control" id="validationCustom01" type="text" placeholder="phoneNumber"
                            required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Harga Tiket</label>
                        <input value="{{ old('price') ?? $item->price }}" name="price" class="form-control"
                            id="validationCustom01" type="text" placeholder="price" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Jam Buka</label>
                        <input value="{{ old('hours') ?? $item->hours }}" name="hours" class="form-control"
                            id="validationCustom01" type="text" placeholder="hours" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Fasilitas</label>
                        <input value="{{ old('facilities') ?? $item->facilities }}" name="facilities"
                            class="form-control" id="validationCustom01" type="text" placeholder="facilities"
                            required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Tipe</label>
                        <input value="{{ old('types') ?? $item->types }}" name="types" class="form-control"
                            id="validationCustom01" type="text" placeholder="types" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="formFile" class="form-label">Icon</label>
                        <input name="image" class="form-control" type="file" id="formFile">
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
@endpush