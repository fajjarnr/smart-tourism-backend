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
        <div class="card earning-card">
            <div class="card-body p-0">
                <div class="row m-0">
                    <div class="row border-top m-0">
                        <div class="col-xl-3 pl-0 col-md-6 col-sm-6">
                            <div class="media p-0">
                                <div class="media-left">
                                    <i class="icofont icofont-users"></i>
                                </div>
                                <div class="media-body">
                                    <h6>User</h6>
                                    <p>$5,000.20</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <div class="media p-0">
                                <div class="media-left bg-secondary">
                                    <i class="icofont icofont-heart-alt"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Wisata Alam</h6>
                                    <p>$2,657.21</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <div class="media p-0">
                                <div class="media-left">
                                    <i class="icofont icofont-cur-dollar"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Wisata Budaya</h6>
                                    <p>$9,478.50</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6">
                            <div class="media p-0">
                                <div class="media-left">
                                    <i class="icofont icofont-cur-dollar"></i>
                                </div>
                                <div class="media-body">
                                    <h6>Rumah Makan</h6>
                                    <p>$9,478.50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card o-hidden profile-greeting">
                <div class="card-body">
                    <div class="media">
                        <div class="badge-groups w-100">
                            <div class="badge f-12"><i class="mr-1" data-feather="clock"></i><span id="txt"></span>
                            </div>
                            <div class="badge f-12"><i class="fa fa-spin fa-cog f-14"></i></div>
                        </div>
                    </div>
                    <div class="greeting-user text-center">
                        <div class="profile-vector"><img class="img-fluid" src="../assets/images/dashboard/welcome.png"
                                alt=""></div>
                        <h4 class="f-w-600"><span id="greeting">Good Morning</span> <span class="right-circle"><i
                                    class="fa fa-check-circle f-14 middle"></i></span></h4>
                        <p><span> Hallo selamat datang kembali <br>{{Auth::user()->name}} </span>
                        </p>
                        <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a></div>
                        <div class="left-icon"><i class="fa fa-bell"> </i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="card-body">
                    <div class="setting-dot">
                        <div class="setting-bg-primary date-picker-setting position-set pull-right"><i
                                class="fa fa-spin fa-cog"></i></div>
                    </div>
                    <div class="default-datepicker">
                        <div class="datepicker-here" data-language="en"></div>
                    </div><span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span
                                class="dots dots1"></span><span class="dots dots2 dot-small"></span><span
                                class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span
                                class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span
                                class="dots dots7 dot-small-semi"></span><span
                                class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">
                            </span></span></span>
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