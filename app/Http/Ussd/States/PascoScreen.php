<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveLibrary;
use App\Models\ExamType;
use Sparors\Ussd\State;

class PascoScreen extends State
{
    protected function beforeRendering(): void
    {
        // Retrieve all exam types from the database
        $examTypes = ExamType::all();

        // Prepare options for listing and map exam type IDs
        $listingOptions = [];
        $examTypeMap = [];
        $index = 1;

        foreach ($examTypes as $examType) {
            $listingOptions[] = $index . '. ' . $examType->name;
            $examTypeMap[$index] = $examType->id;
            $index++;
        }

        // Store the exam type mapping in session record for later use
        $this->record->set('examTypeMap', $examTypeMap);

        // Display the menu to the user
        $this->menu->line('Select your examination type:')
            ->listing($listingOptions);
    }

    protected function afterRendering(string $argument): void
    {
        // Retrieve exam type ID based on user input
        $examTypeMap = $this->record->get('examTypeMap');

        if (isset($examTypeMap[$argument])) {
            $selectedExamTypeId = $examTypeMap[$argument];
            $this->record->set('selectedExamTypeId', $selectedExamTypeId);

            // Proceed to retrieve library action for the selected exam type
            $this->decision->custom(function ($argument) {
                return is_numeric($argument);
            }, RetrieveLibrary::class);
        } else {
            // Handle the case where the user's input is invalid
            $this->menu->line('Invalid selection. Please choose a valid option.');
        }
    }
}
