<?php
namespace App\Traits;

use App\Services\BaseServices;

trait BaseServiceAndRepoTrait {

    public function baseServices() {
        return app(BaseServices::class);
    }
}
