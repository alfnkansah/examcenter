<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveLibrary;
use App\Http\Ussd\Actions\RetrieveResources;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class SelectYear extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        // Display the options to the user
        $this->menu->line('Select an option:')
            ->listing($this->record->get('yearOptions'));
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('yearMapping')[$argument])) {
            // Log::info($this->record->get('yearMapping'));
            $selectedYear = $this->record->get('yearMapping')[$argument];
            // Log::info($selectedYear);
            $this->record->set('selectedYear', $selectedYear);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, RetrieveResources::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
