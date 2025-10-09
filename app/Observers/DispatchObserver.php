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
            $newNumbers = $dispatch->textifyi_numbers ?? null;
            $oldNumbers = $dispatch->getOriginal("textifyi_numbers") ?? null; // = an array
            
            // Set old previous numbers
            $this->usedNumbers($oldNumbers, false);

            // Set new updated changes
            $this->usedNumbers($newNumbers, true);
        }
    }

    private function usedNumbers(array|null $numbers, bool $used) : void
    {
        if(isset($numbers)){
            TextifyiNumber::whereIn('id', $numbers)->update(['used' => $used]);
        }        
    }
}
