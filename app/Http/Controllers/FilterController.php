<?php

namespace App\Http\Controllers;

use App\Services\FilterResourceService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $resourceService;
    protected $slideService;
    protected $examService;

    public function __construct(FilterResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }


    public function fetchFilteredResources(Request $request)
    {
        $id = $request->query('id');

        $html = $this->resourceService->loadInitialResource($id);

        return response()->json(['html' => $html]);
    }

    public function filterResources(Request $request)
    {
        $html = $this->resourceService->loadFilteredResource($request);

        return response()->json(['html' => $html]);
    }


    public function fetchFilteredAnswer(Request $request)
    {
        $id = $request->query('id');

        $html = $this->resourceService->loadInitialAnswer($id);

        return response()->json(['html' => $html]);
    }

    public function filterAnswer(Request $request)
    {
        $html = $this->resourceService->loadFilteredAnswer($request);

        return response()->json(['html' => $html]);
    }
}
