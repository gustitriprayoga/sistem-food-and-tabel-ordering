<div>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                Login ke Niskala Kafe
            </h2>
            <form wire:submit.prevent="authenticate">
                {{ $this->form }}

                <button type="submit" class="w-full mt-6 btn btn-primary">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>
