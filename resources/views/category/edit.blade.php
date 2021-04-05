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

                <form action="{{ route('category.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">
                    @csrf
                    @method('PUT')
                    <div class="col mb-3">
                        <label for="validationCustom01">Category Name</label>
                        <input value="{{ old('name') ?? $item->name }}" name="name" class="form-control"
                            id="validationCustom01" type="text" placeholder="Category name" required="">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col mb-3">
                        <label for="formFile" class="form-label">Icon</label>
                        <input name="icon" class="form-control" type="file" id="formFile">
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