@extends('layouts.app')

@section('title')
Edit Banner
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endpush

@section('content')
<div class="col-12">
    <div class="justify-center">
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
                <form action="{{ route('banner.update', $item->id) }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="formFile" class="form-label">File</label>
                        <input name="picturePath" class="form-control" type="file" id="formFile">
                    </div>

                    {{-- <div class="form-group">
                        <div class="col-form-label">Berita</div>
                        <select name="news_id" class="js-example-basic-single col">
                            <option value="">Pilih Berita</option>
                            @foreach ($news as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                    </select>
            </div> --}}

            <button class="btn btn-success btn-block" type="submit">Submit</button>
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