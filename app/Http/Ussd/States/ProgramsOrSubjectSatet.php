<?php

namespace App\Http\Ussd\States;

use App\Models\Program;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class ProgramsOrSubjectSatet extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        // Display the options to the user
        $this->menu->line('Select an option:')
            ->listing($this->record->get('listingOptions'));
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
