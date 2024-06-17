<?php

namespace App\Http\Ussd\States;

use Sparors\Ussd\State;

class ShowFinalDownloadMessage extends State
{
    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $this->menu->text($this->record->get('finalMessage'));
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
