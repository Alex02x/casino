{{-- resources/views/layouts/app.blade.php --}}
<x-layouts.app :title="$title ?? 'Dashboard'">
    {{ $slot }}
</x-layouts.app>
