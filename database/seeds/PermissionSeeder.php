<?php

use Illuminate\Database\Seeder;
use App\Laravue\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //'view menu customer relation',
            'manage customer'
        ];
        foreach ($permissions as $permission) 
        {
            $user = Permission::create([
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }
    }
}
