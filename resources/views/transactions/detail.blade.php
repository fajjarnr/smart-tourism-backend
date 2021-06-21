@extends('layouts.app')

@section('title')
Transaksi Detail
@endsection

@push('custom-css')

@endpush

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="invoice">
                <div>
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="media">
                                    <div class="media-left"><img class="media-object img-60"
                                            src="{{ asset('assets/images/other-images/logo-login.png') }}" alt=""></div>
                                    <div class="media-body m-l-20">
                                        <h4 class="media-heading">Smart Tourism Pemalang</h4>
                                        <p>hello@smarttourismpemalang.codes<br><span>1122-33-44-5566</span></p>
                                    </div>
                                </div>
                                <!-- End Info-->
                            </div>
                            <div class="col-sm-6">
                                <div class="text-md-right">
                                    <h3>Invoice #<span class="counter">{{ $item->id }}</span></h3>
                                    <p>Issued: <span> {{ $item->created_at }}</span></p>
                                </div>
                                <!-- End Title-->
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- End InvoiceTop-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="media">
                                <div class="media-left"><img class="media-object rounded-circle img-60"
                                        src="{{ $item->user->image_profile }}" alt=""></div>
                                <div class="media-body m-l-20">
                                    <h4 class="media-heading">{{ $item->user->name }}</h4>
                                    <p>{{ $item->user->email }}<br><span>{{ $item->user->phone }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-md-right" id="project">
                                <h6>Alamat</h6>
                                <p>{{ $item->user->address }} <br> {{ $item->user->city }} </p>
                            </div>
                        </div>
                    </div>
                    <!-- End Invoice Mid-->
                    <div>
                        <div class="table-responsive invoice-table" id="table">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td class="item">
                                            <h6 class="p-2 mb-0">Image</h6>
                                        </td>
                                        <td class="item">
                                            <h6 class="p-2 mb-0">Destinasi</h6>
                                        </td>
                                        <td class="Hours">
                                            <h6 class="p-2 mb-0">Quantity</h6>
                                        </td>
                                        <td class="Rate">
                                            <h6 class="p-2 mb-0">Status</h6>
                                        </td>
                                        <td class="subtotal">
                                            <h6 class="p-2 mb-0">Payment URL</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img class="media-object img-60" src="{{ $item->destinations->image }}">
                                        </td>
                                        <td>
                                            <label>{{ $item->destinations->name }}</label>
                                        </td>
                                        <td>
                                            <p class="itemtext">{{ number_format($item->quantity) }}</p>
                                        </td>
                                        <td>
                                            <p class="itemtext">{{ $item->status }}</p>
                                        </td>
                                        <td>
                                            <a href="{{ $item->payment_url }}"
                                                class="itemtext">{{ $item->payment_url }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="Rate">
                                            <h6 class="mb-0 p-2">Total</h6>
                                        </td>
                                        <td class="payment">
                                            <h6 class="mb-0 p-2">{{ number_format($item->total) }}</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table-->
                    </div>
                    <!-- End InvoiceBot-->
                </div>
                <div class="col-sm-12 text-center mt-3">
                    <button class="btn btn btn-primary mr-2" type="button" onclick="myFunction()">Print</button>
                    <button class="btn btn-success mr-2" type="button">
                        <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'ACCEPTED']) }}"
                            class="text-white">ACCEPTED</a>
                    </button>
                    <button class="btn btn-secondary" type="button">
                        <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'CANCELLED']) }}"
                            class="text-white">CANCELLED</a>
                    </button>
                </div>
                <!-- End Invoice-->
                <!-- End Invoice Holder-->
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ asset('assets/js/print.js') }}"></script>
@endpush