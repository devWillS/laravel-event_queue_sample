<?php

declare(strict_types=1);

namespace App\Usecase;

use App\Events\PublishProcessor;

class UserPurchasedBook
{
    const DISABLE_NOTIFICATION = 1;

    public function run(Customer $customer)
    {
        if ($customer->getStatus() === self::DISABLE_NOTIFICATION) {
            if (\Event::hasListeners(PublishProcessor::class)) {
                \Event::forget(PublishProcessor::class);
            }
        }
        \Event::dispatch(new PublishProcessor($customer->getId()));
    }
}

?>