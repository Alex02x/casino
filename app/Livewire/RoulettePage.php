<?php

namespace App\Livewire;

use Livewire\Component;

class RoulettePage extends Component
{
    public function startStakesTraining()
    {
        // Пока просто перенаправим на ту же страницу с параметром или покажем модалку.
        // Позже здесь будет логика запуска тренировки.
        $this->redirectRoute('roulette.stakes'); // или оставьте как заглушку
    }

    public function goToStakesMode()
    {
        return redirect()->route('stakes.mode');
    }

    public function render()
    {
        return view('livewire.roulette-page')
            ->layout('layouts.app', [
                'title' => __('Рулетка — Тренировка'),
            ]);
    }
}
