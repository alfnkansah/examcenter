<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\StoreStudentData;
use Sparors\Ussd\State;

class TakeStudentLevel extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        $this->menu->line('Select Your Level')
            ->listing([
                'J.H.S 1',
                'J.H.S 2',
                'J.H.S 3',
                'S.H.S 1',
                'S.H.S 2',
                'S.H.S 3',
            ]);
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('studentLevel', $argument);

        $this->decision->custom(function ($argument) {
            return is_int((int) $argument);
        }, StoreStudentData::class);
    }
}
