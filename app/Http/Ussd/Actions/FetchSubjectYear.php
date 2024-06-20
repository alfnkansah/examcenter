<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\SelectYear;
use App\Models\Resource;
use Sparors\Ussd\Action;

class FetchSubjectYear extends Action
{
    public function run(): string
    {
        $yearOptions = [];
        $yearMapping = [];
        $index = 1;

        $resources = Resource::where('subject_id', $this->record->get('selectedSubject'))
            ->where('exam_type_id', $this->record->get('selectedExamType'))
            ->where('exam_category_id', $this->record->get('selectedCategory'))
            ->get();
        $examYears = $resources->pluck('exam_year')->unique()->toArray();

        foreach ($examYears as $year) {
            $yearOptions[] = $year;
            $yearMapping[$index] = $year;
            $index++;
        }

        $this->record->set('yearMapping', $yearMapping);
        $this->record->set('yearOptions', $yearOptions);

        return SelectYear::class;
    }
}
