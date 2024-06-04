<?php

namespace App\Services;

use App\Models\ExamCategory;
use App\Models\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;


class FilterResourceService
{
    public function loadInitialResource($id)
    {

        $category = ExamCategory::findOrFail($id);
        $resources = $category->resource;

        $resources = $resources->shuffle()->take(9);

        // Render the view as HTML
        $html = View::make('resource-render', compact('resources'))->render();

        return $html;
    }

    public function loadFilteredResource($request)
    {
        $subjectId = $request->input('subject_id');
        $examYear = $request->input('exam_year');
        $categoryID = $request->input('category_id');
        $category = $request->input('category');

        // Log::info($category);

        $query = Resource::where('exam_category_id', $categoryID);

        if (!is_null($request->input('exam_year')) && !is_null($request->input('subject_id')) && !is_null($request->input('category'))) {
            // Case 7: All parameters specified
            $examYear = $request->input('exam_year');
            $subjectId = $request->input('subject_id');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.exam_year', $examYear)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('exam_year')) && !is_null($request->input('category'))) {
            // Case 6: Year and Category specified
            $examYear = $request->input('exam_year');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.exam_year', $examYear);
        } elseif (!is_null($request->input('subject_id')) && !is_null($request->input('category'))) {
            // Case 5: Subject and Category specified
            $subjectId = $request->input('subject_id');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('subject_id')) && !is_null($request->input('exam_year'))) {
            // Case 4: Subject and Year specified
            $subjectId = $request->input('subject_id');
            $examYear = $request->input('exam_year');

            $query->where('resources.exam_year', $examYear)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('category'))) {
            // Case 3: Only Category specified
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category);
        } elseif (!is_null($request->input('exam_year'))) {
            // Case 2: Only Year specified
            $examYear = $request->input('exam_year');

            $query->where('resources.exam_year', $examYear);
        } elseif (!is_null($request->input('subject_id'))) {
            // Case 1: Only Subject specified
            $subjectId = $request->input('subject_id');

            $query->where('resources.subject_id', $subjectId);
        }

        // Execute the query
        $resources = $query->get();



        $category = ExamCategory::findOrFail($categoryID);


        $html = View::make('resource-render', compact('resources', 'category'))->render();
        return $html;
    }



    public function loadInitialAnswer($id)
    {

        $category = ExamCategory::findOrFail($id);
        $resources = $category->resource;

        $resources = $resources->shuffle()->take(9);

        // Render the view as HTML
        $html = View::make('answer-render', compact('resources'))->render();

        return $html;
    }


    public function loadFilteredAnswer($request)
    {
        $subjectId = $request->input('subject_id');
        $examYear = $request->input('exam_year');
        $categoryID = $request->input('category_id');
        $category = $request->input('category');

        // Log::info($category);

        $query = Resource::where('exam_category_id', $categoryID);

        if (!is_null($request->input('exam_year')) && !is_null($request->input('subject_id')) && !is_null($request->input('category'))) {
            // Case 7: All parameters specified
            $examYear = $request->input('exam_year');
            $subjectId = $request->input('subject_id');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.exam_year', $examYear)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('exam_year')) && !is_null($request->input('category'))) {
            // Case 6: Year and Category specified
            $examYear = $request->input('exam_year');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.exam_year', $examYear);
        } elseif (!is_null($request->input('subject_id')) && !is_null($request->input('category'))) {
            // Case 5: Subject and Category specified
            $subjectId = $request->input('subject_id');
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('subject_id')) && !is_null($request->input('exam_year'))) {
            // Case 4: Subject and Year specified
            $subjectId = $request->input('subject_id');
            $examYear = $request->input('exam_year');

            $query->where('resources.exam_year', $examYear)
                ->where('resources.subject_id', $subjectId);
        } elseif (!is_null($request->input('category'))) {
            // Case 3: Only Category specified
            $category = $request->input('category');

            $query->join('subjects', 'resources.subject_id', '=', 'subjects.id')
                ->where('subjects.tag', $category);
        } elseif (!is_null($request->input('exam_year'))) {
            // Case 2: Only Year specified
            $examYear = $request->input('exam_year');

            $query->where('resources.exam_year', $examYear);
        } elseif (!is_null($request->input('subject_id'))) {
            // Case 1: Only Subject specified
            $subjectId = $request->input('subject_id');

            $query->where('resources.subject_id', $subjectId);
        }

        // Execute the query
        $resources = $query->get();



        $category = ExamCategory::findOrFail($categoryID);


        $html = View::make('answer-render', compact('resources', 'category'))->render();
        return $html;
    }
}
