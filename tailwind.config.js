import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        // --- Tambahkan jalur di bawah ini untuk mengaktifkan styling frontend ---
        './resources/views/**/*.blade.php', // Pindai semua views Blade (termasuk homepage, layout, dll.)
        './app/View/Components/**/*.php',    // Jika Anda menggunakan komponen Blade
        './app/Livewire/**/*.php',          // Pindai semua file kelas Livewire
        // --- Akhir penambahan ---

        // Jalur Filament yang sudah ada:
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    // Jika Anda menggunakan mode JIT/AOT, pastikan ini diaktifkan
    // corePlugins: {
    //     preflight: false,
    // },
    // theme: { ... }
}
