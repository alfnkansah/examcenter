<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveResources;
use Sparors\Ussd\State;

class ShowResourceScreen extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Kindly select a resource')
            ->listing([$this->record->resourcesListingOptions]);
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('resourcesMap')[$argument])) {
            $selectedResource = $this->record->get('resourcesMap')[$argument];
            $this->record->set('selectedResource', $selectedResource);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);

                //! chanage this action class to the right one when you resurme work
            }, RetrieveResources::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
