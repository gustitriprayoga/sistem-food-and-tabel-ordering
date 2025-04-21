@extends('layouts.backend.master')

@section('title', 'Edit User')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Edit User</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Edit User</li>
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
        <!-- Form Edit User -->
        <div class="mb-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Edit User</h4>
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="text" id="name" name="name" class="form-control border border-primary"
                                placeholder="name" value="{{ $user->name }}" />
                            <label for="name">
                                <i class="ti ti-user me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">name</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email" class="form-control border border-primary"
                                placeholder="Email" value="{{ $user->email }}" />
                            <label for="email">
                                <i class="ti ti-mail me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Email address</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" class="form-control border border-primary"
                                placeholder="Password" />
                            <label for="password">
                                <i class="ti ti-lock me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Password</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control border border-primary" placeholder="Password Confirmation" />
                            <label for="password_confirmation">
                                <i class="ti ti-lock me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Password Confirmation</span>
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-select border border-primary">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <label for="role">
                                <i class="ti ti-user-check me-2 fs-4 text-primary"></i>
                                <span class="border-start border-primary ps-3">Role</span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send me-2 fs-4"></i>
                                Submit
                            </button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-back me-2 fs-4"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
