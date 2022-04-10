<?php

namespace App\Providers;

use App\Events\PublishProcessor;
use App\Events\ReviewRregistered;
use App\Listeners\MessageQueueSubscriber;
use App\Listeners\MessageSubscriber;
use App\Listeners\ReviewIndexCreator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Events\Dispatcher;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
        // PublishProcessor::class => [
        //     MessageSubscriber::class,
        // ],
        ReviewRregistered::class => [
            ReviewIndexCreator::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Event::listen(
            PublishProcessor::class, 
            MessageSubscriber::class,
            MessageQueueSubscriber::class,
        );

        $this->app['events']->listen(
            PublishProcessor::class,
            MessageSubscriber::class
        );
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
