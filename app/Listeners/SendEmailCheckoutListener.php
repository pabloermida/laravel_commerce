<?php

namespace CodeCommerce\Listeners;

use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailCheckoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $user = $event->getUser();
        $order = $event->getOrder();
        Mail::send('emails.confirmation', ['user' => $user, 'order' => $order], function ($m) use ($user) {
            $m->from('commerce@commerce.com', 'Laravel Commerce');
            $m->to($user->email, $user->name)->subject('Order Confirmation!');
        });

    }
}
