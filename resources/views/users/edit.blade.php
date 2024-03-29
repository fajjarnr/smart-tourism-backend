@extends('layouts.app')

@section('title')
Edit User
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

                <form action="{{ route('users.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation">

                    @csrf
                    @method('PUT')

                    <div class="col mb-3">
                        <label for="validationCustom01">Nama</label>
                        <input value="{{ old('name') ?? $item->name }}" name="name" class="form-control"
                            id="validationCustom01" type="text" placeholder="Nama" required="" autocomplete="off">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Email</label>
                        <input value="{{ old('email') ?? $item->email }}" name="email" class="form-control"
                            id="validationCustom01" type="email" placeholder="Email" required="" autocomplete="off">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Phone Number</label>
                        <input value="{{ old('phone') ?? $item->phone }}" name="phone" class="form-control"
                            id="validationCustom01" type="text" placeholder="Phone Number" required=""
                            autocomplete="off">
                        <div class="valid-feedback">Looks good!</div>
                    </div>


                    <div class="col mb-3">
                        <label for="validationCustom01">Alamat</label>
                        <input value="{{ old('address') ?? $item->address }}" name="address" class="form-control"
                            id="validationCustom01" type="text" placeholder="Alamat" required="" autocomplete="off">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <label for="validationCustom01">Kota</label>
                        <input value="{{ old('city') ?? $item->city }}" name="city" class="form-control"
                            id="validationCustom01" type="text" placeholder="Kota" required="" autocomplete="off">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col mb-3">
                        <div class="col-form-label">Roles</div>
                        <select name="roles" class="js-example-basic-single col">
                            <option value="{{ $item->roles }}">{{ $item->roles }}</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="col mb-5">
                        <label for="validationCustom02">Photo Profile</label>
                        <input name="profile_photo_path" class="form-control" id="validationCustom02" type="file"
                            placeholder="Photo Profile">
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Update</button>
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