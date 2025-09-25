<?php

namespace App\Livewire;

use Livewire\Component;

class DashboardRouletteBlock extends Component
{
    public function navigateToRoulette()
    {
        return redirect()->route('roulette');
    }

    public function render()
    {
        return view('livewire.dashboard-roulette-block');
    }
}
