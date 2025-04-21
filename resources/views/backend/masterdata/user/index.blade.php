@extends('layouts.backend.master')

@section('title', 'List User')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar User</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Daftar User</li>
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

        <!-- start File export -->
        <div class="card">
            <div class="card-body">
                <div class="mb-2 justify-content-between d-flex">
                    <h4 class="card-title mb-0">Data Semua User</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="ti ti-plus"> |</i> Tambah User</a>
                </div>
                <div class="table-responsive">
                    <table id="file_export" class="table w-100 table-striped table-bordered display text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th width="1%">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="10%">Opsi</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning"> <i class="ti ti-edit"> |</i> Edit</a>
                                        <a href="{{ route('user.destroy', $item->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="ti ti-trash"></i>Delete</a>
                                    </td>
                            @endforeach
                        </tbody>

                </div>
            </div>
        </div>
        <!-- end File export -->
    </div>
@endsection
