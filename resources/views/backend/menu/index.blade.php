@extends('layouts.backend.master')

@section('title', 'List Menu')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar Menu</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Daftar Menu</li>
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

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3 d-flex align-items-center justify-content-between">

            <h5 class="text-uppercase ">List Semua Menu Yang Ada</h5>
            <a href="{{ route('menu.create') }}" class="btn btn-primary"><i class="ti ti-plus"> |</i> Tambah</a>
        </div>
    </div>

    <div class="">
        <div class="card border-start border-danger">
            <div class="card-body">
                <div class="d-flex  align-items-center">
                    <div>
                        <span class="text-danger display-6">
                            <i class="ti ti-users"></i>
                        </span>
                    </div>
                    <div class="ms-auto">
                        <h4 class="card-title fs-7">290</h4>
                        <p class="card-subtitle text-danger">Makanan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($produk as $item)
            @if ($item->kategori->id == 1)
                <div class="col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="position-relative">
                            <a href="javascript:void(0)">
                                <img src="{{ asset('backend/dist/assets/images/products/s4.jpg') }}" class="card-img-top"
                                    alt="modernize-img">
                            </a>
                            <a href="#"
                                class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 me-3 mb-n3">
                                <i class="ti ti-edit"></i>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title">{{ $item->nama }}</h4>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fs-4 mb-0">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                                </div>
                                <ul class="d-flex align-items-center gap-1 mb-0">
                                    <li>
                                        <p>Stok {{ $item->stok }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('menu.destroy', $item->id) }}" class="btn btn-danger" data-confirm-delete="true"><i class="ti ti-trash"> | </i>Hapus</a>
                                <a href="{{ route('menu.edit', $item->id ) }}" class="btn btn-warning"><i class="ti ti-edit"> |</i> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="">
        <div class="card border-start border-primary">
            <div class="card-body">
                <div class="d-flex  align-items-center">
                    <div>
                        <span class="text-primary display-6">
                            <i class="ti ti-users"></i>
                        </span>
                    </div>
                    <div class="ms-auto">
                        <h4 class="card-title fs-7">290</h4>
                        <p class="card-subtitle text-primary">Minuman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($produk as $item)
            @if ($item->kategori->id == 2)
                <div class="col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="position-relative">
                            <a href="javascript:void(0)">
                                <img src="{{ asset('backend/dist/assets/images/products/s4.jpg') }}" class="card-img-top"
                                    alt="modernize-img">
                            </a>
                            <a href="#"
                                class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 me-3 mb-n3">
                                <i class="ti ti-edit"></i>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title">{{ $item->nama }}</h4>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fs-4 mb-0">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                                </div>
                                <ul class="d-flex align-items-center gap-1 mb-0">
                                    <li>
                                        <p>Stok {{ $item->stok }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="btn btn-danger"><i class="ti ti-trash"> |</i> Hapus</a>
                                <a href="{{ route('menu.edit', $item->id ) }}" class="btn btn-warning"><i class="ti ti-edit"> |</i> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="">
        <div class="card border-start border-success">
            <div class="card-body">
                <div class="d-flex  align-items-center">
                    <div>
                        <span class="text-success display-6">
                            <i class="ti ti-users"></i>
                        </span>
                    </div>
                    <div class="ms-auto">
                        <h4 class="card-title fs-7">290</h4>
                        <p class="card-subtitle text-success">Snack</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($produk as $item)
            @if ($item->kategori->id == 3)
                <div class="col-md-6 col-lg-3">
                    <div class="card overflow-hidden">
                        <div class="position-relative">
                            <a href="javascript:void(0)">
                                <img src="{{ asset('backend/dist/assets/images/products/s4.jpg') }}" class="card-img-top"
                                    alt="modernize-img">
                            </a>
                            <a href="#"
                                class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center position-absolute bottom-0 end-0 me-3 mb-n3">
                                <i class="ti ti-edit"></i>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title">{{ $item->nama }}</h4>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="fs-4 mb-0">Rp {{ number_format($item->harga, 0, ',', '.') }}</h5>
                                </div>
                                <ul class="d-flex align-items-center gap-1 mb-0">
                                    <li>
                                        <p>Stok {{ $item->stok }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="#" class="btn btn-danger"><i class="ti ti-trash"> |</i> Hapus</a>
                                <a href="{{ route('menu.edit', $item->id ) }}" class="btn btn-warning"><i class="ti ti-edit"> |</i> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
