<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class Welcome extends State
{
    protected $action = self::INPUT;
    protected function beforeRendering(): void
    {
        $this->menu->line('Welcome to ExamCenter.com.gh!')
            ->line('We provide a platform to access educational resources and information.')
            ->lineBreak()
            ->line('Please choose an option:')
            ->listing([
                'Access Questions Resource',
                'About Us',
                'Contact Support',
            ]);
    }


    protected function afterRendering(string $argument): void
    {
        $this->decision->equal(1, PascoScreen::class);
        $this->decision->equal(2, AboutUs::class);
        $this->decision->equal(3, ContactDetail::class);
    }
}
