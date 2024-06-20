<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\FetchProgramSubjects;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class ShowProgramScreen extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        // Display the options to the user
        $this->menu->line('Select an option:')
            ->listing($this->record->get('programOptions'));
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('programMapping')[$argument])) {
            $selectedProgram = $this->record->get('programMapping')[$argument];
            // Log::info($selectedProgram);
            $this->record->set('selectedProgram', $selectedProgram);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, FetchProgramSubjects::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
