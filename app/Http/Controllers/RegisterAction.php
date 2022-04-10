<?php

namespace App\Http\Controllers;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Events\ReviewRegistered;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterAction extends Controller
{
    private $provider;

    private $dispatcher;

    public function __construct(
        RegisterReviewProviderInterface $provider,
        Dispatcher $dispatcher
    )
    {
        $this->provider = $provider;
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(Request $request): Response
    {
        $created = Carbon::now()->toDateTimeString();

        $id = $this->provider->save(
            $request->get('title'),
            $request->get('content'),
            $request->get('user_id', 1),
            $created,
            $request->get('tags'),
        );

        $this->dispatcher->dispatch(
            new ReviewRegistered(
                $id,
                $request->get('title'),
                $request->get('content'),
                $request->get('user_id', 1),
                $created,
                $request->get('tags')
            )
        );

        return new Response('', Response::HTTP_OK);
    }
}
