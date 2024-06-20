<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\ProgramsOrSubjectAction;
use App\Models\ExamType;
use App\Models\Program;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class SelectSubjectType extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        $selectedExamType = ExamType::find($this->record->get('selectedExamType'));
        if ($selectedExamType) {
            if ($selectedExamType->programs()->exists()) {
                $this->menu->line('Please choose an option:')
                    // ->line('We provide a platform to access educational resources and information.')
                    ->lineBreak()
                    ->listing([
                        'Core Subjects',
                        'Elective Subjects'
                    ]);
            } else {
                $this->menu->line('Please choose an option:')
                    // ->line('We provide a platform to access educational resources and information.')
                    ->lineBreak()
                    ->listing([
                        'Core Subjects'
                    ]);
            }
        }
    }

    protected function afterRendering(string $argument): void
    {
        // Initialize the subjectType variable
        $subjectType = null;

        // Check the value of argument and set subjectType accordingly
        if (isset($argument) && $argument === '1') { // Ensure argument comparison is correct
            $this->record->set('subjectType', 'core');
            $subjectType = 'core';
        } elseif (isset($argument) && $argument === '2') {
            $this->record->set('subjectType', 'elective');
            $subjectType = 'elective';
        }
        Log::info($subjectType);
        $this->decision->custom(function ($argument) {
            return is_int((int) $argument);
        }, ProgramsOrSubjectAction::class);
    }
}
