<?php

namespace App\Http\Ussd\States;

use App\Services\UssdService;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class Welcome extends State
{

    protected $action = self::INPUT;
    protected function beforeRendering(): void
    {
        $phoneNumber = $this->record->phoneNumber;

        $message = (new UssdService)->saveContact($phoneNumber);

        $this->menu->line('Welcome to ExamCenter.com.gh!')
            // ->line('We provide a platform to access educational resources and information.')
            ->lineBreak()
            ->line('Please choose an option:')
            ->lineBreak()
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
