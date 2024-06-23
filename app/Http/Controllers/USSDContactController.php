<?php

namespace App\Http\Controllers;

use App\Services\UssdService;
use Illuminate\Http\Request;

class USSDContactController extends Controller
{
    protected $ussdService;

    public function __construct(UssdService $ussdService)
    {
        $this->ussdService = $ussdService;
    }

    // Display a listing of the resource
    public function index()
    {
        $contacts = $this->ussdService->getAllContacts();

        return view('ussd-contacts.index', compact('contacts'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $message = $this->ussdService->saveContact($request);
        return response()->json($message);
    }

    // Display the specified resource
    public function show($id)
    {
        $contact = $this->ussdService->getContactById($id);
        return response()->json($contact);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $message = $this->ussdService->updateContact($request, $id);
        return response()->json($message);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $message = $this->ussdService->deleteContact($id);

        return redirect()->route('ussd.index')->with('success', $message);
    }
}
