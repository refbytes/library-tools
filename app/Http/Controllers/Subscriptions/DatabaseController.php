<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Subscriptions\Database;

class DatabaseController extends Controller
{
    public function __invoke(Database $database)
    {
        return view('subscriptions.database', [
            'database' => $database,
        ]);
    }
}
