<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailWelcomeUser
{
    private $event;

    public function handle(UserCreated $event)
    {
        // dd($event);
        $data['title'] = "Bienvenido ". $event->user->name;

        $this->event = $event;

        Mail::send('emails.email', $data, function($message){
            $message->to($this->event->user->email, $this->event->user->name)
            ->sender('al221910354@gmail.com', 'Alan Mauricio Reyes Telesforo')
            ->subject("Gracias por ser parte de nuestra familia ". $this->event->user->name);
        });
    }
}
