@extends('layouts.backend.master')

@section('title')

@section('content')

    <!--  Owl carousel -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-warning-subtle text-success rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-basket fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">{{ $countMakanan }}</h4>
                                <h6 class="card-subtitle mb-0">Makanan</h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-success" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="{{ $countMakanan }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('menu.index') }}" class="btn btn-primary btn-sm"> <i class="ti ti-plus"> |</i> Cek Semua </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-warning-subtle text-primary rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-basket fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">{{ $countMinuman }}</h4>
                                <h6 class="card-subtitle mb-0">Minuman</h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-primary" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="{{ $countMinuman }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('menu.index') }}" class="btn btn-primary btn-sm"> <i class="ti ti-plus"> |</i> Cek Semua </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-warning-subtle text-warning rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-basket fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">{{ $countSnack }}</h4>
                                <h6 class="card-subtitle mb-0">Snack</h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-warning" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="{{ $countSnack }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('menu.index') }}" class="btn btn-primary btn-sm"> <i class="ti ti-plus"> |</i> Cek Semua </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-primary-subtle text-primary rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-chart-pie fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">{{ $countMeja }}</h4>
                                <h6 class="card-subtitle mb-0">Total Meja</h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-primary" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="{{ $countMeja }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-danger-subtle text-danger rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-user-plus fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">{{ $countUser }}</h4>
                                <h6 class="card-subtitle mb-0">Total Pengguna</h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-danger" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="{{ $countUser }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-success-subtle text-success rounded d-flex align-items-center p-8 justify-content-center">
                                <i class="ti ti-bell fs-8"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">156</h4>
                                <h6 class="card-subtitle mb-0">
                                    New Notifications
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3 text-bg-light">
                        <div class="progress-bar text-bg-success" role="progressbar" style="width: 26%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--  Row 1 -->
@endsection
