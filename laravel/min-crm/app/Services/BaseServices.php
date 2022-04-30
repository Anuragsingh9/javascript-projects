<?php

namespace App\Services;

use App\Services\BusinessServices\IEmailServices;

class BaseServices {

    /**
     * @var IEmailServices
     */
    public $emailService;

    public function __construct(
        IEmailServices $emailServices
    ) {
        $this->emailService = $emailServices;
    }

}
