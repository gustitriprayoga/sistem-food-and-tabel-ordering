<x-filament-panels::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- KOLOM KIRI --}}
        <div class="lg:col-span-1">
            {{ $this->table }}
        </div>

        {{-- KOLOM KANAN --}}
        <div class="lg:col-span-2">
            <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">Status Meja</h3>

                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-4"
                    wire:poll.10s="refreshMeja">
                    @foreach ($semuaMeja as $meja)
                        @php
                            $status = strtolower($meja->status ?? 'lainnya');
                            $bgColor = match ($status) {
                                'tersedia' => 'bg-green-500 hover:bg-green-600',
                                'dipesan' => 'bg-yellow-500 hover:bg-yellow-600',
                                'ditempati' => 'bg-red-500 hover:bg-red-600',
                                default => 'bg-gray-500 hover:bg-gray-600',
                            };
                        @endphp

                        <div class="{{ $bgColor }} rounded-lg shadow-lg text-white p-4 h-24
                            flex flex-col items-center justify-center text-center
                            cursor-pointer transition-all duration-200">
                            <span class="font-bold text-lg">{{ $meja->nama }}</span>
                            <span class="text-xs capitalize">{{ str_replace('_', ' ', $status) }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Legenda --}}
                <div class="mt-6 flex flex-wrap gap-4">
                    <h4 class="w-full text-sm font-semibold text-gray-700 dark:text-gray-300">Legenda:</h4>

                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-green-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Tersedia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-yellow-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Dipesan</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-red-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Ditempati</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded-full bg-gray-500"></div>
                        <span class="text-xs text-gray-600 dark:text-gray-300">Lainnya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
