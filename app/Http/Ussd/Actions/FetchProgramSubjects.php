<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\ResourceNotFound;
use App\Http\Ussd\States\ShowSubjectScreen;
use App\Models\Program;
use App\Models\Subject;
use Sparors\Ussd\Action;

class FetchProgramSubjects extends Action
{
    public function run(): string
    {
        $programSubjectOptions = [];
        $subjectMap = [];
        $index = 1;

        $subjects = Program::find($this->record->get('selectedProgram'))->subjects()
            ->whereHas('resources')
            ->get();


        if ($subjects->isEmpty()) {
            return ResourceNotFound::class;
        }

        foreach ($subjects as $subject) {
            $programSubjectOptions[] = $subject->name;
            $subjectMap[$index] = $subject->id;
            $index++;
        }

        $this->record->set('subjectMapping', $subjectMap);
        $this->record->set('subjectOptions', $programSubjectOptions);

        return ShowSubjectScreen::class;
    }
}
