<x-layouts.app title="Тренировка — {{ ucfirst(str_replace('-', ' ', $mode)) }}">
    <div class="p-6 text-center">
        <h2 class="text-2xl font-bold mb-4">Режим: {{ match($mode) {
            '1-2' => '1–2 стэка',
            '3-plus' => '3+ стэков',
            'ultra' => 'Ultra Mode (20+ стэков)',
            default => 'Неизвестный режим'
            }
        }}</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Интерфейс тренировки будет здесь.</p>
        <a href="{{ route('stakes.mode') }}" class="text-blue-600 hover:underline">← Вернуться к выбору режима</a>
    </div>
</x-layouts.app>
