<?php
namespace App\Event;
use Symfony\Contracts\EventDispatcher\Event;

class MyEvent extends Event {
    private $mail;
    public function __construct() {
        $this->mail = 'kandji.k66@gmail.com';

    }

    public function getMail()
    {
        return $this->mail;
    }
}