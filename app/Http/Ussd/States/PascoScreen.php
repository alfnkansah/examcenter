<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveLibrary;
use App\Models\ExamType;
use Sparors\Ussd\State;

class PascoScreen extends State
{
    protected function beforeRendering(): void
    {
        $examTypes = ExamType::all();

        $listingOptions = [];
        $examTypeMap = [];
        $index = 1;

        foreach ($examTypes as $examType) {
            $listingOptions[] = $examType->short_name;
            $examTypeMap[$index] = $examType->id;
            $index++;
        }
        $this->record->set('examTypeMap', $examTypeMap);

        $this->menu->line('Kindly select your examination type')
            ->listing($listingOptions);
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('examTypeMap')[$argument])) {
            $selectedexamType = $this->record->get('examTypeMap')[$argument];

            $this->record->set('selectedexamType', $selectedexamType);

            // $this->decision->any(ShowLibraryScreen::class);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, RetrieveLibrary::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
