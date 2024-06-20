<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\FetchSubjectYear;
use Illuminate\Support\Facades\Log;
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
        if (isset($this->record->get('subjectMapping')[$argument])) {
            $selectedSubject = $this->record->get('subjectMapping')[$argument];
            // Log::info($selectedSubject);
            $this->record->set('selectedSubject', $selectedSubject);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, FetchSubjectYear::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
