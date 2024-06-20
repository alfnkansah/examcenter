<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\ShowResourceScreen;
use App\Http\Ussd\States\Welcome;
use App\Models\ExamCategory;
use App\Models\Resource;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Action;

class RetrieveResources extends Action
{
    public function run(): string
    {
        $examTypeId = $this->record->get('selectedExamType');
        $examCategoryId = $this->record->get('selectedCategory');
        $subjectId = $this->record->get('selectedSubject');
        $examYear = $this->record->get('selectedYear');

        $resources = Resource::where('exam_type_id', $examTypeId)
            ->where('exam_category_id', $examCategoryId)
            ->where('subject_id', $subjectId)
            ->where('exam_year', $examYear)
            ->get();


        $resourcesListingOptions = [];
        $resourcesMap = [];
        $index = 1;

        foreach ($resources as $resource) {
            $resourcesListingOptions[] = $resource->subject->name . '-' . $resource->exam_year . '-' . $resource->questionType->name;
            $resourcesMap[$index] = $resource->id;
            $index++;
        }
        $this->record->set('resourcesMap', $resourcesMap);
        $this->record->set('resourcesListingOptions', $resourcesListingOptions);

        return ShowResourceScreen::class;
    }
}
