@extends('layouts.app')

@section('title')
Create Comment
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
            <form action="{{ route('comment.store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="form-floating mb-3">
                    <label for="floatingTextarea2">Comment</label>
                    <textarea value="{{ old('comment') }}" name="comment" class="form-control" placeholder="Content"
                        id="floatingTextarea2" style="height: 100px"></textarea>
                </div>
                <div class="col mb-3">
                    <div class="col-form-label">Article</div>
                    <select name="news" class="js-example-basic-single col">
                        <option value="">Select a News</option>
                        @foreach ($news as $item)
                        <option value="news_id">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col mb-5">
                    <div class="col-form-label">User</div>
                    <select name="user" class="js-example-basic-single col">
                        <option value="">Select a User</option>
                        @foreach ($user as $item)
                        <option value="user_id">{{ $item->name }}</option>
                        @endforeach
                    </select>
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