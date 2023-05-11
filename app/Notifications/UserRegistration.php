<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistration extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */public $user, $password;
    public function __construct($user,$pass)
    {
        $this->user = $user;
        $this->password = $pass;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // dd($this->user->name,$this->password);
        $user = $this->user;
        return (new MailMessage)
                    ->greeting('Dear '.$user['name'])
                    ->subject('Account Registration Confirmation')
                    ->line('Congratulations! Your account registration with '.config('app.name').' is complete. We are thrilled to have you on board and ready to serve you')
                    ->line('To get started, please use the login credentials provided below:')
                    ->line('Email: '.$user->email. '  Password: '.$this->password)
                    ->action('Log in', route('login'))
                    ->line('Thank you for choosing us! We are excited to have you on board and would like to extend a warm welcome to our platform..');

                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
