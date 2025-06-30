<x-filament-panels::page>
    {{-- Kita bungkus semuanya dengan wire:ignore untuk memastikan JavaScript kustom kita
         berjalan tanpa gangguan dari Livewire. --}}
    <div wire:ignore>
        {{-- Dropdown untuk memilih Denah --}}
        <div class="mb-4 max-w-xs">
            <label for="denah-selector" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilih
                Denah</label>
            <select id="denah-selector"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700">
                {{-- Loop data denah yang dikirim dari file Page PHP --}}
                @forelse ($this->semuaDenah as $denah)
                    <option value="{{ $denah->id }}" data-path-gambar="{{ $denah->path_gambar }}">
                        {{ $denah->nama }}
                    </option>
                @empty
                    <option disabled>Tidak ada denah yang tersedia</option>
                @endforelse
            </select>
        </div>

        {{-- Container utama untuk denah dan meja-meja --}}
        <div id="denah-container"
            class="relative w-full bg-gray-200 dark:bg-gray-800 border rounded-lg shadow overflow-hidden"
            style="height: 70vh;">
            {{-- Wrapper ini akan berisi semua elemen meja yang bisa digeser --}}
            <div id="meja-wrapper">
                {{-- Meja akan dirender di sini oleh JavaScript --}}
            </div>
            {{-- Indikator loading saat data sedang diambil --}}
            <div id="loading" class="absolute inset-0 flex items-center justify-center bg-white/50 dark:bg-black/50"
                style="display: none;">
                <x-filament::loading-indicator class="h-10 w-10" />
            </div>
        </div>

        <!-- Keterangan / Legenda Warna -->
        <div class="mt-4 p-4 bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <div class="flex justify-start items-center gap-x-6 gap-y-2 flex-wrap">
                <h4 class="text-sm font-medium dark:text-gray-300 w-full mb-1 sm:w-auto sm:mb-0">Legenda:</h4>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full" style="background-color: #22c55e;"></div>
                    <span class="text-xs dark:text-gray-400">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full" style="background-color: #f59e0b;"></div>
                    <span class="text-xs dark:text-gray-400">Dipesan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full" style="background-color: #ef4444;"></div>
                    <span class="text-xs dark:text-gray-400">Ditempati</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded-full" style="background-color: #6b7280;"></div>
                    <span class="text-xs dark:text-gray-400">Tidak Tersedia</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Blok CSS untuk styling denah dan meja --}}
    <style>
        #denah-container {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .meja-item {
            position: absolute;
            width: 80px;
            /* Sedikit lebih lebar untuk teks status */
            height: 70px;
            border-radius: 8px;
            color: white;
            display: flex;
            flex-direction: column;
            /* Susun teks ke bawah */
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: move;
            touch-action: none;
            user-select: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
            transition: all 0.2s ease;
            padding: 4px;
            text-align: center;
        }

        .meja-item strong {
            font-size: 1rem;
            /* Ukuran font nama meja */
        }

        .meja-item small {
            font-size: 0.7rem;
            /* Ukuran font status */
            text-transform: capitalize;
            margin-top: 2px;
            opacity: 0.9;
        }

        .meja-item:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
            /* Sedikit membesar saat di-hover */
        }

        /* Kelas CSS untuk setiap status meja */
        .status-tersedia {
            background-color: rgba(34, 197, 94, 0.85);
        }

        .status-dipesan {
            background-color: rgba(245, 158, 11, 0.85);
        }

        .status-ditempati {
            background-color: rgba(239, 68, 68, 0.85);
        }

        .status-tidak_tersedia {
            background-color: rgba(107, 114, 128, 0.85);
            border-style: dashed;
        }

        #meja-wrapper {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
    </style>

    @push('scripts')
        {{-- Muat library Interact.js dari CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Ambil semua elemen DOM yang dibutuhkan
                const denahSelector = document.getElementById('denah-selector');
                const denahContainer = document.getElementById('denah-container');
                const mejaWrapper = document.getElementById('meja-wrapper');
                const loading = document.getElementById('loading');
                let currentDenahId = null; // Variabel untuk menyimpan ID denah yang sedang aktif

                // Fungsi utama untuk memuat data denah dan meja dari API
                async function loadDenah(denahId) {
                    if (!denahId) {
                        mejaWrapper.innerHTML = '<p class="text-center p-4">Silakan pilih denah.</p>';
                        denahContainer.style.backgroundImage = 'none';
                        return;
                    }
                    loading.style.display = 'flex';
                    try {
                        const response = await fetch(`/api/denah/${denahId}/meja`);
                        if (!response.ok) throw new Error('Gagal memuat data meja.');
                        const denahData = await response.json();

                        // Atur gambar latar belakang denah
                        const imageUrl = `/storage/${denahData.path_gambar}`;
                        if (denahContainer.style.backgroundImage !== `url("${imageUrl}")`) {
                            denahContainer.style.backgroundImage = `url('${imageUrl}')`;
                        }

                        // Panggil fungsi untuk merender meja ke layar
                        renderMeja(denahData.meja);

                    } catch (error) {
                        console.error('Error lengkap:', error);
                        alert('Terjadi kesalahan saat memuat denah.');
                    } finally {
                        loading.style.display = 'none';
                    }
                }

                // Fungsi untuk membuat elemen HTML meja berdasarkan data
                function renderMeja(mejaData) {
                    mejaWrapper.innerHTML = ''; // Kosongkan isi sebelumnya

                    const allowedStatuses = ['tersedia', 'dipesan', 'ditempati', 'tidak_tersedia'];

                    mejaData.forEach(meja => {
                        const mejaEl = document.createElement('div');
                        let status = (meja.status || 'tidak_tersedia').toLowerCase().replace(/\s+/g, '_');
                        if (!allowedStatuses.includes(status)) status = 'tidak_tersedia';

                        console.log(`Render meja ${meja.nama} dengan status ${status}`);

                        mejaEl.className = `meja-item status-${status}`;
                        mejaEl.innerHTML =
                            `<strong>${meja.nama}</strong><small>${status.replace('_', ' ')}</small>`;
                        mejaEl.setAttribute('data-id', meja.id);

                        const posX = meja.posisi_x || 50;
                        const posY = meja.posisi_y || 10;
                        mejaEl.style.left = `${posX}px`;
                        mejaEl.style.top = `${posY}px`;
                        mejaEl.setAttribute('data-x', '0');
                        mejaEl.setAttribute('data-y', '0');

                        mejaWrapper.appendChild(mejaEl);
                    });

                    // Hapus interact sebelumnya agar tidak dobel
                    interact('.meja-item').unset();

                    // Bind ulang interact setelah render selesai
                    interact('.meja-item').draggable({
                        listeners: {
                            move: function(event) {
                                const target = event.target;
                                let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                                let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                                target.style.transform = `translate(${x}px, ${y}px)`;
                                target.setAttribute('data-x', x);
                                target.setAttribute('data-y', y);
                            },
                            end: async function(event) {
                                const target = event.target;
                                const mejaId = target.getAttribute('data-id');
                                const initialX = parseFloat(target.style.left) || 0;
                                const initialY = parseFloat(target.style.top) || 0;
                                const deltaX = parseFloat(target.getAttribute('data-x')) || 0;
                                const deltaY = parseFloat(target.getAttribute('data-y')) || 0;
                                const finalX = Math.round(initialX + deltaX);
                                const finalY = Math.round(initialY + deltaY);

                                target.style.left = `${finalX}px`;
                                target.style.top = `${finalY}px`;
                                target.style.transform = '';
                                target.setAttribute('data-x', '0');
                                target.setAttribute('data-y', '0');

                                try {
                                    await fetch(`/api/meja/${mejaId}/posisi`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content'),
                                            'Accept': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            posisi_x: finalX,
                                            posisi_y: finalY
                                        }),
                                    });
                                } catch (error) {
                                    console.error('Gagal menyimpan posisi meja:', error);
                                }
                            }
                        },
                        modifiers: [
                            interact.modifiers.restrictRect({
                                restriction: 'parent',
                                endOnly: true
                            })
                        ],
                        inertia: true
                    });
                }

                // Tambahkan event listener untuk dropdown
                denahSelector.addEventListener('change', (event) => {
                    currentDenahId = event.target.value;
                    loadDenah(currentDenahId);
                });

                // Muat denah pertama kali saat halaman dibuka
                if (denahSelector.value) {
                    currentDenahId = denahSelector.value;
                    loadDenah(currentDenahId);
                }

                // Atur auto-refresh untuk status meja setiap 15 detik
                setInterval(() => {
                    if (currentDenahId) {
                        console.log('Memuat ulang status meja...');
                        loadDenah(currentDenahId);
                    }
                }, 15000); // 15 detik

                // Inisialisasi Interact.js untuk fungsionalitas drag-and-drop
                interact('.meja-item').draggable({
                    listeners: {
                        // Fungsi saat meja sedang digeser
                        move: function(event) {
                            const target = event.target;
                            let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                            let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                            // Update tampilan visual menggunakan transform untuk gerakan yang mulus
                            target.style.transform = `translate(${x}px, ${y}px)`;

                            // Simpan offset pergeseran
                            target.setAttribute('data-x', x);
                            target.setAttribute('data-y', y);
                        },
                        // Fungsi saat selesai menggeser (mouse dilepas)
                        end: async function(event) {
                            const target = event.target;
                            const mejaId = target.getAttribute('data-id');

                            // Ambil posisi 'home' awal dari style
                            const initialX = parseFloat(target.style.left) || 0;
                            const initialY = parseFloat(target.style.top) || 0;

                            // Ambil total pergeseran dari atribut data
                            const deltaX = parseFloat(target.getAttribute('data-x')) || 0;
                            const deltaY = parseFloat(target.getAttribute('data-y')) || 0;

                            // Hitung posisi final
                            const finalX = Math.round(initialX + deltaX);
                            const finalY = Math.round(initialY + deltaY);

                            // Update posisi 'home' elemen
                            target.style.left = finalX + 'px';
                            target.style.top = finalY + 'px';

                            // Reset transform dan atribut data
                            target.style.transform = '';
                            target.setAttribute('data-x', '0');
                            target.setAttribute('data-y', '0');

                            // Kirim posisi baru ke server
                            try {
                                await fetch(`/api/meja/${mejaId}/posisi`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        posisi_x: finalX,
                                        posisi_y: finalY
                                    }),
                                });
                            } catch (error) {
                                console.error('Gagal menyimpan posisi meja:', error);
                            }
                        }
                    },
                    // Batasi pergerakan hanya di dalam container denah
                    modifiers: [interact.modifiers.restrictRect({
                        restriction: 'parent'
                    })],
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
