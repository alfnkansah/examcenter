<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ShowCancelScreenState extends State
{
    protected $action = self::PROMPT;
    protected function beforeRendering(): void
    {
        $this->menu->text('Process Canceled, Thank You');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
