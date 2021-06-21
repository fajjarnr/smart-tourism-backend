@extends('layouts.app')

@section('title')
Edit News
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endpush

@section('content')
<div class="col">
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
            <form action="{{ route('news.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                class="needs-validation">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="validationCustom01">Title</label>
                    <input value="{{ old('title') ?? $item->title }}" name="title" class="form-control"
                        id="validationCustom01" type="text" placeholder="title" required="" autocomplete="off">
                    <div class="valid-feedback">good!</div>
                </div>
                <div class="form-floating mb-3">
                    <label for="floatingTextarea2">Content</label>
                    <textarea value="{{ old('content') ?? $item->content }}" name="content" class="form-control"
                        placeholder="content" id="floatingTextarea2" style="height: 100px"
                        autocomplete="off">{{ $item->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">File</label>
                    <input name="picturePath" class="form-control" type="file" id="formFile">
                </div>
                <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endpush