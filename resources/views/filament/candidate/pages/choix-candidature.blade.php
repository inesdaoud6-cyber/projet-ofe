<x-filament-panels::page>
    <div class="grid grid-cols-2 gap-6">

        <div class="p-6 bg-gray-800 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold text-yellow-400 mb-4">
                📋 Candidat Libre
            </h2>
            <p class="text-gray-400 mb-6">
                Postulez sans offre spécifique. L'admin vous proposera un test adapté.
            </p>
            <button wire:click="candidatLibre"
                class="px-6 py-3 bg-yellow-500 text-white rounded-lg font-bold hover:bg-yellow-600">
                Choisir cette option
            </button>
        </div>

        <div class="p-6 bg-gray-800 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold text-green-400 mb-4">
                💼 Postuler à une Offre
            </h2>
            <p class="text-gray-400 mb-6">
                Postulez à une offre d'emploi spécifique publiée par l'entreprise.
            </p>
            <a href="/candidate/offres"
                class="px-6 py-3 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600">
                Voir les offres
            </a>
        </div>

    </div>
</x-filament-panels::page>