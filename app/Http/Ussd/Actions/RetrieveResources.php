<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\ShowResourceScreen;
use App\Http\Ussd\States\Welcome;
use App\Models\ExamCategory;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Action;

class RetrieveResources extends Action
{
    public function run(): string
    {
        $category = ExamCategory::where('id', $this->record->selectedCategory)->first();
        if (!$category) {
            // return PascoScreen::class;
        }

        $resources = $category->resources;

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
