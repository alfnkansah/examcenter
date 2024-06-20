<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ResourceNotFound extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->text('Sorry: we do not have materials available now, kindly try again next time');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
