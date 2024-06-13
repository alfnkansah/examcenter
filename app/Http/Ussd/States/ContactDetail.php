<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ContactDetail extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
        $this->menu->line('Welcome to ExamCenter.com.gh, our contact deatails below')
            ->line('Phone: 0200000000 / 0200000000')
            ->line('Email: support@examcenter.com.gh')
            ->line('Email: info@examcenter.com.gh');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
