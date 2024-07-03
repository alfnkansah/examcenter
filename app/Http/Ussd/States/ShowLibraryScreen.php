<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\RetrieveResources;
use Sparors\Ussd\State;

class ShowLibraryScreen extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        $this->menu->line('Select Examination')
            ->lineBreak()
            ->listing($this->record->categoriesListingOptions);
    }

    protected function afterRendering(string $argument): void
    {
        if (isset($this->record->get('categoriesMap')[$argument])) {
            $selectedCategory = $this->record->get('categoriesMap')[$argument];

            $this->record->set('selectedCategory', $selectedCategory);

            $this->decision->custom(function ($argument) {
                return is_int((int) $argument);
            }, SelectSubjectType::class);
        } else {
            // Handle the case where the user's input is invalid
        }
    }
}
