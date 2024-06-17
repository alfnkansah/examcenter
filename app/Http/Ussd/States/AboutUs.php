<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class AboutUs extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->line('About ExamCenter.com.gh')
            ->line('ExamCenter.com.gh is dedicated to providing access to educational resources and information.')
            ->line('Our mission is to facilitate learning and preparation through digital platforms.')
            ->line('For more details, visit our website or contact us:')
            ->line('www.examcenter.com.gh');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
