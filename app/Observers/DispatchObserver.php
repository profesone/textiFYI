<?php

namespace App\Observers;

use App\Models\Dispatch;
use App\Models\TextifyiNumber;

use function PHPUnit\Framework\isArray;

class DispatchObserver
{
    public function saved(Dispatch $dispatch): void
    {
        // Set TextiFYI Numbers to used and add Dispatch ID
        if ($dispatch->isDirty('textifyi_numbers')) {
            if  (
                    isset($dispatch->getChanges()["textifyi_numbers"])
                    && isArray($dispatch->getOriginal("textifyi_numbers"))
                )
                {
                $this->usedNumbers($dispatch->getOriginal("textifyi_numbers"), false);
            }

            if  (
                    isset($dispatch->getChanges()["textifyi_numbers"])
                    && isArray(json_decode($dispatch->getChanges()["textifyi_numbers"], true))
                ) {
                $this->usedNumbers(
                    json_decode($dispatch->getChanges()["textifyi_numbers"], true),
                     true
                );
            }
        }
    }

    private function usedNumbers(array|null $numbers, bool $used) : void
    {
        if(isset($numbers)){
            TextifyiNumber::whereIn('id', $numbers)
            ->update(['used' => $used]);
        }        
    }
}
