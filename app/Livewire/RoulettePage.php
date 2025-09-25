<?php

namespace App\Livewire;

use Livewire\Component;

class RoulettePage extends Component
{
    public string $mode = 'stakes'; // по умолчанию — заставки

    public function render()
    {
        return view('livewire.roulette-page')
            ->layout('layouts.app', [
                'title' => __('Рулетка — Тренировка'),
            ]);
    }
}
