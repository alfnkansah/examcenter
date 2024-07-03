<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveLibrary;
use App\Models\ExamType;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class PascoScreen extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        // Retrieve exam types that have associated resources
        $examTypes = ExamType::whereHas('resources')->get();
        // Log::info($examTypes);
        // Prepare options for listing and map exam type IDs
        $listingOptions = [];
        $examTypeMap = [];
        $index = 1;

        foreach ($examTypes as $examType) {
            $listingOptions[] = $examType->short_name;
            $examTypeMap[$index] = $examType->id;
            $index++;
        }

        // Store the exam type mapping in session record for later use
        $this->record->set('examTypeMap', $examTypeMap);

        // Display the menu to the user
        $this->menu->line('Download Free PASSCO, Mock Papers,etc')
            ->lineBreak()
            ->line('Choose Level')
            ->lineBreak()
            ->listing($listingOptions);
    }


    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('examTypeMap')[$argument])) {
            $selectedexamType = $this->record->get('examTypeMap')[$argument];
            // Log::info($selectedexamType);
            $this->record->set('selectedExamType', $selectedexamType);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, RetrieveLibrary::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
