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

    <div class="mb-3">
        <form method="POST" action="{{ route('meja.store') }}">
            @csrf
            <div class="input-group" style="max-width: 300px;">
                <input type="text" name="nama" class="form-control" placeholder="Nama Meja (misal: A1)" required>
                <button class="btn btn-primary" type="submit">Tambah Meja</button>
            </div>
        </form>
    </div>

    <div class="w-100 d-flex justify-content-center">
        <div id="denah" style="width: 800px; height: 600px;" class="position-relative border rounded bg-light">
            @foreach ($meja as $item)
                <div class="meja position-absolute d-flex flex-column justify-content-start text-white fw-bold shadow"
                    data-id="{{ $item->id }}"
                    style="width: 60px; height: 60px; border-radius: 10px;
                   left: {{ $item->pos_x }}px; top: {{ $item->pos_y }}px;
                   background-color: {{ match ($item->status) {
                       'tersedia' => '#28a745',
                       'booking' => '#FFDE59',
                       'tidak tersedia' => '#E4080A',
                       default => '#ffffff',
                   } }};
                   cursor: move;">
                    <div class="mt-1">{{ $item->nama }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    <!-- Style jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!-- Baru jalankan skrip kamu -->
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
