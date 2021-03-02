@extends('layouts.app')

@section('title')
Edit Category
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
                        <input name="icon" class="custom-file-input" id="validationCustom02" type="file"
                            placeholder="Icon" required="">
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