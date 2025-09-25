<?php

namespace App\Livewire;

use Livewire\Component;

class RoulettePage extends Component
{
    public string $view = 'modes'; // 'modes', 'stakes', 'training'
    public ?string $selectedStakesMode = null; // '1-2', '3-plus', 'ultra'

    public function showStakesModes()
    {
        $this->view = 'stakes';
    }

    public function startTraining(string $mode)
    {
        $this->selectedStakesMode = $mode;
        $this->view = 'training';
    }

    public function goBack()
    {
        if ($this->view === 'training') {
            $this->view = 'stakes';
        } elseif ($this->view === 'stakes') {
            $this->view = 'modes';
        }
    }

    public function render()
    {
        return view('livewire.roulette-page')
            ->layout('layouts.app', [
                'title' => __('Рулетка — Тренировка'),
            ]);
    }
}
