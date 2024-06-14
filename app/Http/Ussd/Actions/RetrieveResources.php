<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\ShowResourceScreen;
use App\Http\Ussd\States\Welcome;
use App\Models\ExamCategory;
use Sparors\Ussd\Action;

class RetrieveResources extends Action
{
    public function run(): string
    {
        $category = ExamCategory::where('id', $this->record->selectedCategory)->first();
        if (!$category) {
            // return PascoScreen::class;
        }

        $resources = $category->resource;


        $resourcesListingOptions = [];
        $resourcesMap = [];
        $index = 1;

        foreach ($resources as $resource) {
            $resourcesListingOptions[] = $resource->name;
            $resourcesMap[$index] = $resource->id;
            $index++;
        }
        $this->record->set('resourcesMap', $resourcesMap);
        $this->record->set('resourcesListingOptions', $resourcesListingOptions);

        return Welcome::class;
    }
}
