<?php

namespace App\Console\Commands;

use App\Models\Teachers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AssignRoles extends Command
{
    protected $signature = 'assign:roles {userType}';
    protected $description = 'Assigns specific roles to user types based on predefined mappings.';

    public function handle()
    {
        $userType = $this->argument('userType');
        $providerKey = $this->getUserTypeProviderKey($userType);
        $modelClass = config("auth.providers.{$providerKey}.model");

        if (!$modelClass) {
            $this->error("Invalid user type provided or config not found for '{$userType}'. Check your config/auth.php.");
            return 1;
        }

        $roleName = $this->getRoleNameByUserType($userType);
        if (!$roleName) {
            $this->error("Role name not found for user type '{$userType}'.");
            return 1;
        }

        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' does not exist. Please check your database.");
            return 1;
        }

        $usersWithoutRole = $modelClass::doesntHave('roles')->get();
        $count = 0;

        foreach ($usersWithoutRole as $user) {
            $user->assignRole($role);
            $count++;
            $this->info("Assigned '{$role->name}' role to {$user->email}");
        }

        $this->info("Total of {$count} users of type '{$userType}' have been assigned the '{$role->name}' role.");
        return 0;
    }

    private function getUserTypeProviderKey($userType)
    {
        // Returns the provider key based on user type, assuming they are plural in config
        return strtolower($userType) . 's';
    }

    private function getRoleNameByUserType($userType)
    {
        $teacher = new Teachers();
        $teacher->first_name = 'John';
        $teacher->last_name = 'Doe';
        $teacher->email = 'john.doe@example.com';
        $teacher->school = 'y';
        $teacher->password = Hash::make('secret');
        $teacher->save();

        // Maps user types to role names explicitly
        $mapping = [
            'teacher' => 'Teacher',
            'administrator' => 'Administrator',
            'dean' => 'Dean',
            'student' => 'Student'
        ];

        return $mapping[strtolower($userType)] ?? null;
    }
}



