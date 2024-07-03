<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveResources;
use App\Http\Ussd\Actions\StoreStudentData;
use App\Http\Ussd\Actions\TakeStudentData;
use Sparors\Ussd\State;

class ShowResourceScreen extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Kindly select a resource')
            ->lineBreak()
            ->listing($this->record->resourcesListingOptions);
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('resourcesMap')[$argument])) {
            $selectedResource = $this->record->get('resourcesMap')[$argument];
            $this->record->set('selectedResource', $selectedResource);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, TakeStudentData::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
