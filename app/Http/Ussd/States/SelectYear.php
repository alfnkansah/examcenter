<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveLibrary;
use Sparors\Ussd\State;

class SelectYear extends State
{
    protected function beforeRendering(): void
    {
        $currentYear = now()->year;
        $startYear = 2015;
        $years = [];
        for ($year = $currentYear; $year >= $startYear; $year--) {
            $years[] = $year;
        }

        $this->menu->line('Please choose an option:')
            ->lineBreak()
            ->listing($years); // Pass the $years array to listing()
    }

    protected function afterRendering(string $argument): void
    {

        $selectedYear = $this->record->set('subjectType', $argument);


        $this->decision->custom(function ($argument) {
            return is_int((int) $argument);
        }, RetrieveLibrary::class);
    }
}
