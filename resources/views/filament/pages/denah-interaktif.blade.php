<x-filament-panels::page>
    {{-- Tambahkan wire:ignore untuk mencegah Livewire mengganggu JS kustom kita --}}
    <div wire:ignore>
        {{-- Dropdown untuk memilih Denah --}}
        <div class="mb-4 max-w-xs">
            <label for="denah-selector" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilih
                Denah</label>
            <select id="denah-selector"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700">
                @forelse ($this->semuaDenah as $denah)
                    <option value="{{ $denah->id }}" data-path-gambar="{{ $denah->path_gambar }}">
                        {{ $denah->nama }}
                    </option>
                    {{-- @dd($denah->path_gambar) --}}
                @empty
                    <option disabled>Tidak ada denah yang tersedia</option>
                @endforelse
            </select>
        </div>

        {{-- Container untuk denah dan meja-meja --}}
        <div id="denah-container"
            class="relative w-full bg-gray-200 dark:bg-gray-800 border rounded-lg shadow overflow-hidden"
            style="height: 70vh;">
            <div id="meja-wrapper">
                {{-- Meja akan dirender di sini --}}
            </div>
            <div id="loading" class="absolute inset-0 flex items-center justify-center bg-white/50 dark:bg-black/50"
                style="display: none;">
                <x-filament::loading-indicator class="h-10 w-10" />
            </div>
        </div>
    </div>

    {{-- Style tidak berubah --}}
    <style>
        #denah-container {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .meja-item {
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 8px;
            background-color: rgba(59, 130, 246, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: move;
            touch-action: none;
            user-select: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 2px solid white;
            transition: box-shadow 0.2s ease;
        }

        .meja-item:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
    </style>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const denahSelector = document.getElementById('denah-selector');
                const denahContainer = document.getElementById('denah-container');
                const mejaWrapper = document.getElementById('meja-wrapper');
                const loading = document.getElementById('loading');

                // Fungsi utama untuk memuat denah dan mejanya
                async function loadDenah(denahId) {
                    if (!denahId) {
                        mejaWrapper.innerHTML = '<p class="text-center p-4">Silakan pilih denah.</p>';
                        denahContainer.style.backgroundImage = 'none';
                        return;
                    }

                    loading.style.display = 'flex';
                    mejaWrapper.innerHTML = ''; // Kosongkan meja lama

                    try {
                        const selectedOption = denahSelector.options[denahSelector.selectedIndex];
                        const pathGambar = selectedOption.getAttribute('data-path-gambar');

                        // --- TAMBAHKAN KODE INI UNTUK DEBUGGING ---
                        const imageUrl = `/storage/${pathGambar}`;
                        console.log('Mencoba mengatur background ke URL:', imageUrl);
                        // -----------------------------------------

                        denahContainer.style.backgroundImage = `url('${imageUrl}')`;


                        // Ambil data meja dari API
                        const response = await fetch(`/api/denah/${denahId}/meja`);
                        if (!response.ok) {
                            // Jika gagal, coba dapatkan pesan error dari server
                            const errorData = await response.json().catch(() => null);
                            throw new Error(
                                `Gagal memuat data meja. Status: ${response.status}. Pesan: ${errorData?.message || 'Tidak ada pesan.'}`
                            );
                        }

                        const denahData = await response.json();
                        renderMeja(denahData.meja);

                    } catch (error) {
                        console.error('Error lengkap:', error);
                        alert('Terjadi kesalahan saat memuat denah. Cek Console (F12) untuk detail.');
                    } finally {
                        loading.style.display = 'none';
                    }
                }

                function renderMeja(mejaData) {
                    mejaData.forEach(meja => {
                        const mejaEl = document.createElement('div');
                        mejaEl.className = 'meja-item';
                        mejaEl.textContent = meja.nama;
                        mejaEl.setAttribute('data-id', meja.id);
                        mejaEl.style.left = `${meja.posisi_x || 50}px`;
                        mejaEl.style.top = `${meja.posisi_y || 50}px`;
                        mejaEl.setAttribute('data-x', meja.posisi_x || 50);
                        mejaEl.setAttribute('data-y', meja.posisi_y || 50);
                        mejaWrapper.appendChild(mejaEl);
                    });
                }

                // Event listener untuk dropdown
                denahSelector.addEventListener('change', (event) => {
                    loadDenah(event.target.value);
                });

                // Muat denah pertama kali saat halaman dibuka
                if (denahSelector.value) {
                    loadDenah(denahSelector.value);
                }

                // Kode Interact.js tidak berubah, tetap sama seperti sebelumnya
                interact('.meja-item').draggable({
                    listeners: {
                        // --- PERUBAHAN DI SINI ---
                        // event saat item sedang digeser
                        move(event) {
                            const target = event.target;
                            // Dapatkan posisi yang sudah tersimpan di data-attributes
                            let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                            let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                            // Update posisi visual HANYA menggunakan transform untuk pergerakan mulus
                            target.style.transform =
                                `translate(${x - (parseFloat(target.style.left) || 0)}px, ${y - (parseFloat(target.style.top) || 0)}px)`;

                            // Tetap update data-attributes dengan posisi terbaru
                            target.setAttribute('data-x', x);
                            target.setAttribute('data-y', y);
                        },

                        // --- PERUBAHAN DI SINI ---
                        // event saat item selesai digeser (dilepas)
                        async end(event) {
                            const target = event.target;
                            const mejaId = target.getAttribute('data-id');

                            // Ambil posisi final dari data-attributes
                            const finalX = Math.round(parseFloat(target.getAttribute('data-x')));
                            const finalY = Math.round(parseFloat(target.getAttribute('data-y')));

                            // 1. "Kunci" posisi baru ke style top dan left
                            target.style.left = `${finalX}px`;
                            target.style.top = `${finalY}px`;

                            // 2. Reset transform agar elemen tidak "melayang"
                            target.style.transform = '';

                            // 3. Simpan posisi baru ke server
                            try {
                                const response = await fetch(`/api/meja/${mejaId}/posisi`, {
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
                                if (!response.ok) throw new Error('Gagal menyimpan posisi');

                                const result = await response.json();
                                console.log(result.message);

                            } catch (error) {
                                console.error('Error:', error);
                                alert('Gagal menyimpan posisi meja.');
                            }
                        }
                    },
                    modifiers: [
                        interact.modifiers.restrictRect({
                            restriction: 'parent'
                        })
                    ],
                    inertia: true
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
