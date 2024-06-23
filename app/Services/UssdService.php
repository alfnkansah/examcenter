<?php

namespace App\Services;

use App\Models\USSDContact;
use Illuminate\Http\Request;

class UssdService
{
    public function getAllContacts()
    {
        return USSDContact::all();
    }

    public function saveContact($phoneNumber)
    {
        // $phoneNumber->validate([
        //     'phone_number' => 'required|string|max:255',
        // ]);

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
