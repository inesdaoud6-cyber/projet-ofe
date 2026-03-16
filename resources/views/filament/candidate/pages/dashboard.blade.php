<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-6">
        <div class="p-6 bg-gray-800 rounded-lg shadow text-center">
            <h2 class="text-xl font-bold text-white mb-4">
                👋 Bienvenue sur votre espace candidat !
            </h2>
            <p class="text-gray-400 mb-6">
                Choisissez votre type de candidature pour commencer.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('candidate.libre') }}"
                    class="px-6 py-3 bg-yellow-500 text-white rounded-lg font-bold hover:bg-yellow-600">
                    📋 Candidat Libre
                </a>
                <a href="{{ route('candidate.offre') }}"
                    class="px-6 py-3 bg-green-500 text-white rounded-lg font-bold hover:bg-green-600">
                    💼 Postuler à une Offre
                </a>
            </div>
        </div>
    </div>
</x-filament-panels::page>