<?php

namespace App\Services;

use App\Models\USSDContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UssdService
{
    public function getAllContacts()
    {
        return USSDContact::orderBy('created_at')->get();
    }



    public function saveContact($phoneNumber)
    {
        // Check if the contact already exists
        $existingContact = USSDContact::where('phone_number', $phoneNumber)->first();

        if ($existingContact) {
            // Log::info("Contact already exists!");
            return 'Contact already exists!';
        }

        // If the contact does not exist, save it
        $contact = new USSDContact([
            'phone_number' => $phoneNumber,
        ]);

        $contact->save();

        return 'Contact saved!';
    }




    public function getContactById($id)
    {
        return USSDContact::findOrFail($id);
    }

    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'phone_number' => 'required|string|max:255',
        ]);

        $contact = USSDContact::findOrFail($id);
        $contact->phone_number = $request->get('phone_number');
        $contact->save();

        return 'Contact updated!';
    }

    public function deleteContact($id)
    {
        $contact = USSDContact::findOrFail($id);
        $contact->delete();


        return 'Contact deleted!';
    }
}
