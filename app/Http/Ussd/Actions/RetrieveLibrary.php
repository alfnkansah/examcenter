<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\PascoScreen;
use App\Http\Ussd\States\ShowLibraryScreen;
use App\Models\ExamCategory;
use App\Models\ExamType;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Action;

class RetrieveLibrary extends Action
{
    public function run(): string
    {
        $examType = ExamType::where('id', $this->record->selectedExamType)->first();
        if (!$examType) {
            return PascoScreen::class;
        }
        $categories = ExamCategory::where('exam_type_id', $examType->id)->get();

        $categoriesListingOptions = [];
        $categoriesMap = [];
        $index = 1;

        foreach ($categories as $category) {
            $categoriesListingOptions[] = $category->name;
            $categoriesMap[$index] = $category->id;
            $index++;
        }
        $this->record->set('categoriesMap', $categoriesMap);
        $this->record->set('categoriesListingOptions', $categoriesListingOptions);

        return ShowLibraryScreen::class; // The state after this
    }
}
