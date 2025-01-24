<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveTagPersonNotification extends Notification
{
    use Queueable;

    public $leaveid;
    public $title;
    public $studentid;

    public function __construct($id, $title, $studentid)
    {
        $this->leaveid = $id;
        $this->title = $title;
        $this->studentid = $studentid;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'id'=>$this->leaveid,
            'title'=>$this->title,
            'studentid'=>$this->studentid
        ];
    }
}

// php artisan make:notification LeaveTagPersonNotification

// php artisan make:notification AnnouncementEmailNotify