<?php

namespace App\Console\Commands;

use App\Models\Codename;
use Illuminate\Console\Command;
use App\Models\Students;

class AssignCodenames extends Command
{
    protected $signature = 'codenames:assign';
    protected $description = 'Assigns codenames to students without codenames who have an upcoming visit date.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $students = Students::whereNull('codename_id')
            ->where(function ($query) {
                $query->whereNull('visit_date')
                    ->orWhere('visit_date', '>=', now()->toDateString());
            })
            ->take(40)->get();

        $codenames = Codename::where('is_assigned', false)->inRandomOrder()->take(count($students))->get();

        foreach ($students as $key => $student) {
            $student->codename_id = $codenames[$key]->id;
            $codenames[$key]->is_assigned = true;
            $codenames[$key]->save();
            $student->save();
        }
    }
}
