@extends('layouts.app')

@section('title')
Transaksi &raquo; {{ $item->destinations->name }} by {{ $item->user->name }}
@endsection

@push('custom-css')

@endpush

@section('content')
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Data Transaksi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ $item->destinations->image }}">
                    </div>
                    <div class="col-6">
                        <div class="row px-3">
                            <div class="col-4 mb-3">
                                <div class="text-sm">Destinasi</div>
                                <div class="text-xl font-bold">{{ $item->destinations->name }}</div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="text-sm">Quantity</div>
                                <div class="text-xl font-bold">{{ number_format($item->quantity) }}</div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="text-sm">Total</div>
                                <div class="text-xl font-bold">{{ number_format($item->total) }}</div>
                            </div>
                        </div>
                        <div class="row px-3 mb-3">
                            <div class="col-6">
                                <div class="text-sm">Nama</div>
                                <div class="text-xl font-bold">{{ $item->user->name }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-sm">Email</div>
                                <div class="text-xl font-bold">{{ $item->user->email }}</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col mb-3">
                                <div class="text-sm">Adress</div>
                                <div class="text-xl font-bold">{{ $item->user->address }}</div>
                            </div>
                            <div class="col mb-3">
                                <div class="text-sm">Payment Url</div>
                                <div class="text-lg font-bold">
                                    <a href="{{ $item->payment_url }}">{{ $item->payment_url }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col mb-3">
                            <div class="text-sm">Status</div>
                            <div class="text-xl font-bold">{{ $item->status }}</div>
                        </div>
                        <div class="col mb-3">
                            <div class="text-sm">City</div>
                            <div class="text-xl font-bold">{{ $item->user->city }}</div>
                        </div>
                        <div class="col mb-3">
                            <div class="text-sm">Phone</div>
                            <div class="text-xl font-bold">{{ $item->user->phoneNumber }}</div>
                        </div>
                        <div class="col mb-3">
                            <div class="text-sm mb-1">Change Status</div>
                            <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'ACCEPTED']) }}"
                                class="bg-success text-white font-bold rounded d-block text-center mb-1">ACCEPTED</a>

                            <a href="{{ route('transactions.changeStatus', ['id' => $item->id, 'status' => 'CANCELLED']) }}"
                                class="bg-danger text-white font-bold rounded d-block text-center mb-1">CANCELLED</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')

@endpush