<?php
namespace App\Services\BusinessServices;

interface IEmailServices{

    /**
     * @param $user
     * @return mixed
     */
    public function sendWelcomeEmail($user);
}
