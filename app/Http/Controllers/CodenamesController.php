<?php

// In app/Http/Controllers/CodenamesController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CodenamesController extends Controller
{
    public function assignCodenames()
    {
        Artisan::call('codenames:assign');
        return redirect()->back()->with('success', 'Codenames assigned successfully.');
    }

    public function clearCodenames()
    {
        Artisan::call('codenames:clear');
        return redirect()->back()->with('success', 'Codenames cleared successfully.');
    }

}
