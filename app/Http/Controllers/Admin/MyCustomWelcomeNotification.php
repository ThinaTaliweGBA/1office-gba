<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Spatie\WelcomeNotification\WelcomeNotification;

class MyCustomWelcomeNotification extends WelcomeNotification
{
    public function buildWelcomeNotificationMessage(): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to my app')
            ->action(Lang::get('Set initial password'), $this->showWelcomeFormUrl);
    }
}