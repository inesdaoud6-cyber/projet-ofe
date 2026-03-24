<x-filament-panels::page>
    <div class="grid grid-cols-2 gap-6">

        <div class="p-6 bg-gray-800 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold text-yellow-400 mb-4">
                📋 {{ __('Free Application') }}
            </h2>
            <p class="text-gray-400 mb-6">
                {{ __('Apply without a specific offer. The admin will suggest a suitable test for you.') }}
            </p>
            <button wire:click="candidatLibre"
                class="px-6 py-3 bg-yellow-500 text-white rounded-lg font-bold hover:bg-yellow-600">
                {{ __('Choose this option') }}
            </button>
        </div>

        <div class="p-6 bg-gray-800 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold text-green-400 mb-4">
                💼 {{ __('Apply to an Offer') }}
            </h2>
            <p class="text-gray-400 mb-6">
                {{ __('Apply to a specific job offer published by the company.') }}
            </p>
            <a href="/candidate/offres"
                class="px-6 py-3 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600">
                {{ __('View offers') }}
            </a>
        </div>

    </div>
</x-filament-panels::page>