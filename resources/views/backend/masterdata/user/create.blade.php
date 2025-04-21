@extends('layouts.backend.master')

@section('title', 'Tambah User')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Tambah User</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Tambah User</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('backend/dist/assets/images/breadcrumb/ChatBc.png') }}" alt="modernize-img"
                            class="img-fluid mb-n4" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        <!-- Form Tambah User -->
        <div class="mb-3">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Pengisian Akun User Baru </h4>
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" id="name" name="name" class="form-control border border-primary" placeholder="name" />
                            <label for="name">
                                <i class="ti ti-user me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">name</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email" class="form-control border border-primary" placeholder="Email" />
                            <label for="email">
                                <i class="ti ti-mail me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Email address</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" class="form-control border border-primary" placeholder="Password" />
                            <label for="password">
                                <i class="ti ti-lock me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Password</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control border border-primary" placeholder="Confirm Password" />
                            <label for="password_confirmation">
                                <i class="ti ti-lock me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Confirm Password</span>
                            </label>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 ms-auto">
                                <button type="submit" class="btn btn-primary hstack gap-6">
                                    <i class="ti ti-send me-2 fs-4"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Form Hapus User -->

    @endsection
