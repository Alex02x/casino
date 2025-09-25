<?php

namespace App\Livewire;

use Livewire\Component;

class StakesModeSelector extends Component
{
    public function selectMode(string $mode)
    {
        // Пока просто перенаправим на заглушку тренировки
        // Позже здесь можно передавать $mode в сессию или URL
        session(['stakes_mode' => $mode]);

        return redirect()->route('stakes.training');
    }

    public function render()
    {
        return view('livewire.stakes-mode-selector')
            ->layout('layouts.app', [
                'title' => __('Выбор режима — Заставки'),
            ]);
    }
}
