<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    private $monitoring;

    public function __construct()
    {
        $this->monitoring = new Monitoring();
    }

    protected function getDari()
    {
        return now()->firstOfMonth()->toDateString();
    }

    protected function getSampai()
    {
        return now()->lastOfMonth()->toDateString();
    }
}
