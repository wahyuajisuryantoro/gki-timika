<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Statistik Total Jemaat -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Total Jemaat</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalJemaat }}</p>
        </div>

        <!-- Statistik Jemaat Aktif -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Jemaat Aktif</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $activeJemaat }}</p>
        </div>

        <!-- Statistik Jemaat Tidak Aktif -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Jemaat Tidak Aktif</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $inactiveJemaat }}</p>
        </div>
    </div>
</x-filament-panels::page>
