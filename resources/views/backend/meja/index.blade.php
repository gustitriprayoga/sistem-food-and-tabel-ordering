@extends('layouts.backend.master')

@section('title', 'List Meja')

@section('content')

    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar Meja</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Daftar Meja</li>
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
        <!-- Form Tambah Meja -->
        <div class="mb-3">
            <form method="POST" action="{{ route('meja.store') }}">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Meja (misal: Meja 1)"
                            required>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="kode" class="form-control" placeholder="Kode Meja (misal: M1)"
                            required>
                    </div>
                    <div class="col-auto">
                        <select name="bentuk" class="form-select" required>
                            <option value="kotak">Kotak</option>
                            <option value="bulat">Bulat</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Tambah Meja</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Form Hapus Meja -->
        <div class="mb-3 mt-3">
            <form method="POST" action="{{ route('meja.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <select name="id" class="form-select" required>
                            <option value="">Pilih Meja untuk Dihapus</option>
                            @foreach ($meja as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ $item->kode }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('meja.destroy', ['id' => $item->id]) }}" class="btn btn-danger"
                            data-confirm-delete="true">
                            Delete
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- Denah Meja -->
    <div class="container-fluid px-0">
        <div class="denah-wrapper position-relative w-100 border rounded overflow-hidden"
            style="aspect-ratio: 9/16; background-image: url('{{ asset('backend/images/denah/denah.png') }}'); background-size: cover; background-position: center;">
            @foreach ($meja as $item)
                <div class="meja position-absolute d-flex flex-column justify-content-center align-items-center text-white fw-bold shadow"
                    data-id="{{ $item->id }}"
                    style="width: 5.5vw; height: 5.5vw;
                        max-width: 60px; max-height: 60px;
                        border-radius: {{ $item->bentuk === 'bulat' ? '50%' : '10px' }};
                        left: calc({{ $item->pos_x }} / 1080 * 100%);
                        top: calc({{ $item->pos_y }} / 1920 * 100%);
                        background-color: {{ match ($item->status) {
                            'tersedia' => '#28a745',
                            'booking' => '#FFDE59',
                            'tidak tersedia' => '#E4080A',
                            default => '#ffffff',
                        } }};
                        cursor: move;">
                    <div class="text-center">{{ $item->kode }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- jQuery & jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script>
        $(function() {
            $('.meja').draggable({
                containment: '#denah',
                stop: function(event, ui) {
                    let id = $(this).data('id');
                    let x = ui.position.left;
                    let y = ui.position.top;

                    $.ajax({
                        url: '{{ route('meja.update.posisi') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            pos_x: x,
                            pos_y: y
                        },
                        success: function(res) {
                            console.log('Posisi meja disimpan');
                        }
                    });
                }
            });
        });
    </script>

@endsection
