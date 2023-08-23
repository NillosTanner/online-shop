<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;

class ShopStaffInvitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $shopName)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Вас пригласили :shop сотрудником :app', [
                'shop' => $this->shopName,
                'app'  => config('app.name'),
            ]))
            ->markdown('mail.shop.staff-invitation', [
                'setUrl' => $this->resetUrl($notifiable),
                'shop'   => $this->shopName,
                'requestNewUrl' => route('password.request'),
            ]);
    }

    protected function resetUrl($notifiable)
    {
        return url(route('password.reset', [
            'token' => Password::createToken($notifiable),
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
