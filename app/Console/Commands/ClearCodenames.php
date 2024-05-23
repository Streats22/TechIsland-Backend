<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Students;
use App\Models\Codename;

class ClearCodenames extends Command
{
    protected $signature = 'codenames:clear';
    protected $description = 'Clears codenames for students whose visit date has passed.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Students::whereNotNull('codename_id')
            ->where('visit_date', '<', now()->toDateString())
            ->each(function ($student) {
                $codename = Codename::find($student->codename_id);
                $codename->is_assigned = false;
                $codename->save();
                $student->codename_id = null;
                $student->save();
            });
    }
}
