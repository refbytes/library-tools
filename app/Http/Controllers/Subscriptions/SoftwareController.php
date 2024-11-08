<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions\Software;

class SoftwareController extends Controller
{
    public function __invoke(Software $software)
    {
        return view('subscriptions.software', [
            'software' => $software,
        ]);
    }
}
