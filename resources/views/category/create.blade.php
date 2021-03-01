@extends('layouts.app')

@section('title')
Create Category
@endsection

@section('content')
<div class="col-6">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">
                    @csrf
                    <div class="col mb-3">
                        <label for="validationCustom01">Category Name</label>
                        <input value="{{ old('name') }}" name="name" class="form-control" id="validationCustom01"
                            type="text" placeholder="Category name" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col mb-3">
                        <label for="validationCustom02">Icon</label>
                        <input name="icon" class="form-control" id="validationCustom02" type="file" placeholder="Icon"
                            required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <button class="btn btn-success btn-block" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
@endpush