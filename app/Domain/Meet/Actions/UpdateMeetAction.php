<?php

namespace Domain\Meet\Actions;

use Domain\Meet\Models\Meet;

class UpdateMeetAction
{
    public function execute(Meet $meet): void
    {
        $meet->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
