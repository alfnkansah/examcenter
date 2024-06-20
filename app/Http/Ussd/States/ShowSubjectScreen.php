<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ShowSubjectScreen extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        // Display the options to the user
        $this->menu->line('Select an option:')
            ->listing($this->record->get('subjectOptions'));
    }


    protected function afterRendering(string $argument): void
    {
        //
    }
}
