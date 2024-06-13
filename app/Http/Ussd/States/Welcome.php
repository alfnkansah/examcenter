<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Welcome extends State
{
    protected $action = self::INPUT;
    protected function beforeRendering(): void
    {
        $this->menu->line('Welcome to ExamCenter.com.gh, please select an option:')
            ->listing([
                'Pasco',
                'About',
            ]);
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal(1, PascoScreen::class);
        $this->decision->equal(3, ContactDetail::class);
    }
}
