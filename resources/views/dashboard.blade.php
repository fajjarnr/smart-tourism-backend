@extends('layouts.app')

@section('title')
Dashboard
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-info b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                            <div class="media-body"><span class="m-0">Kategori</span>
                                <h4 class="mb-0 counter">{{ $category->count() }}</h4><i class="icon-bg"
                                    data-feather="database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="map"></i></div>
                            <div class="media-body"><span class="m-0">Destinasi</span>
                                <h4 class="mb-0 counter">{{ $destination->count() }}</h4><i class="icon-bg"
                                    data-feather="map"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-warning b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="file-text"></i></div>
                            <div class="media-body"><span class="m-0">Berita</span>
                                <h4 class="mb-0 counter">{{ $news->count() }}</h4><i class="icon-bg"
                                    data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                            <div class="media-body"><span class="m-0">User</span>
                                <h4 class="mb-0 counter">{{ $user->count() }}</h4><i class="icon-bg"
                                    data-feather="user-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 box-col-12 col-lg-12 col-md-12">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div class="ecommerce-widgets media">
                            <div class="media-body">
                                <p class="f-w-500 font-roboto">Jumlah Transaksi<span
                                        class="badge pill-badge-primary ml-3">Hot</span></p>
                                <h4 class="f-w-500 mb-0 f-26"><span class="counter">{{ $transaction->count() }}</span>
                                </h4>
                            </div>
                            <div class="ecommerce-box light-bg-primary"><i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 xl-100 box-col-12">
        <div class="card">
            <div class="cal-date-widget card-body">
                <div class="row">
                    <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                        <div class="cal-info text-center">
                            <div class="d-inline-block mt-4">
                                <div class="profile-vector"><img class="b-r-10"
                                        src="{{asset('storage/'.Auth::user()->profile_photo_path)}}" width="150"
                                        height="150" />
                                </div>
                            </div>
                            <p class="mt-4 f-16 text-muted">Hallo selamat datang kembali <br>
                                <strong>{{Auth::user()->name}}</strong> </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                        <div class="cal-datepicker">
                            <div class="datepicker-here float-sm-right" data-language="en"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/dashboard/default.js"></script>
<script src="../assets/js/notify/index.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
@endpush