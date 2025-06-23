<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deleteExistingRoles();

        $data = [
            [
                "name" => "User",
                "role" => User::$user,
            ],
            [
                "name" => "Admin",
                "role" => User::$admin,
            ]
        ];

        DB::table("roles")->insert($data);
    }

    protected function deleteExistingRoles(): void
    {
        DB::table("roles")->delete();
    }
}
