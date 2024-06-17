<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class TakeStudentName extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        $this->menu->line("We want to know you more:")->line('Enter Your Full Name');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('studentName', $argument);

        $this->decision->custom(function ($argument) {
            return is_string($argument);
        }, TakeStudentLevel::class);
    }
}
