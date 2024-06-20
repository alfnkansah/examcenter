<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\ProgramsOrSubjectSatet;
use App\Http\Ussd\States\ResourceNotFound;
use App\Http\Ussd\States\ShowProgramScreen;
use App\Http\Ussd\States\ShowSubjectScreen;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Action;

class ProgramsOrSubjectAction extends Action
{
    public function run(): string
    {
        $listingOptions = [];
        $mapping = [];
        $index = 1;

        if ($this->record->get('subjectType') == 'core') {
            // Query subjects with tag 'core' and that have records in the resource table
            $subjects = Subject::where('tag', 'core')
                ->where('exam_type_id', $this->record->get('selectedExamType'))
                ->whereHas('resources')
                ->get();
            if ($subjects->isEmpty()) {
                return ResourceNotFound::class;
            }

            foreach ($subjects as $subject) {
                $listingOptions[] = $subject->name;
                $mapping[$index] = $subject->id;
                $index++;
            }
        } elseif ($this->record->get('subjectType') == 'elective') {
            $programs = Program::where('exam_type_id', $this->record->get('selectedExamType'))
                ->whereHas('subjects.resources')
                ->get();

            if ($programs->isEmpty()) {
                return ResourceNotFound::class;
            }

            foreach ($programs as $program) {
                $listingOptions[] = $program->name;
                $mapping[$index] = $program->id;
                $index++;
            }

            $this->record->set('programMapping', $mapping);
            $this->record->set('programOptions', $listingOptions);
            return ShowProgramScreen::class;
        }

        $this->record->set('subjectMapping', $mapping);
        $this->record->set('subjectOptions', $listingOptions);

        return ShowSubjectScreen::class;
    }
}
