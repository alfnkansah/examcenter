<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class SelectSubjectType extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Please choose an option:')
            // ->line('We provide a platform to access educational resources and information.')
            ->lineBreak()
            ->listing([
                'Core Subjects',
                'Elective Subjects'
            ]);
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($argument) && $argument == 1) {
            $subjectType = $this->record->set('subjectType', 'core');
        } elseif (isset($argument) && $argument == 2) {
            $subjectType = $this->record->set('subjectType', 'elective');
        } else {
        }

        $this->decision->custom(function ($argument) {
            return is_int((int) $argument);
        }, SelectYear::class);
    }
}
