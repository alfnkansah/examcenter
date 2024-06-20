<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\SendUssdSMS;
use App\Models\Resource;
use App\Models\StudentResource;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\State;

class PreviewDownLoadRequest extends State
{
    protected $action = self::INPUT;

    protected function beforeRendering(): void
    {
        $resource = StudentResource::where('id', $this->record->student_resource_id)->first();

        if (!$resource) {
            $this->menu->text('Sorry: we do not have materials available now, kindly try again next time');
        }

        $this->menu->line('Your have requested to download')
            ->line($resource->resource->subject->name . '-' . $resource->resource->exam_year . '-' . $resource->resource->questionType->name)
            ->line('Please confirm your choice:')
            ->listing([
                'Confirm',
                'Cancel Process'
            ]);
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal(1, SendUssdSMS::class);
        $this->decision->equal(2, ShowCancelScreenState::class);
    }
}
