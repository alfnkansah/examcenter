<?php

namespace App\Http\Ussd\States;

use App\Models\Program;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class ProgramsOrSubjectSatet extends State
{
    protected function beforeRendering(): void
    {
        $listingOptions = [];
        $mapping = [];
        $index = 1;

        if ($this->record->get('subjectType') == 'core') {
            // Query subjects with tag 'core' and that have records in the resource table
            $subjects = Subject::where('tag', 'core')
                ->where('exam_type_id', $this->record->get('selectedexamType'))
                ->whereHas('resources')
                ->get();

            foreach ($subjects as $subject) {
                $listingOptions[] = $subject->name;
                $mapping[$index] = $subject->id;
                $index++;
            }
        } elseif ($this->record->get('subjectType') === 'elective') {
            $programs = Program::whereHas('subjects.resources')
                ->where('exam_type_id', $this->record->get('selectedExamType'))
                ->get();

            foreach ($programs as $program) {
                $listingOptions[] = $program->name;
                $mapping[$index] = $program->id;
                $index++;
            }
        }

        Log::info($listingOptions);
        $this->record->set('mapping', $mapping);

        // Display the options to the user
        $this->menu->line('Select an option:')
            ->listing($listingOptions);
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
