<?php

namespace App\Listeners;

use App\Traits\Color;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateColor extends Registered
{
    use Color;
    public $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $user = $this->user;

        parent::__construct($user);
    }

    /**
     * Handle the event.
     *
     * @param  Registred  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->color = $this->generateRandomColor();
    }
}
