<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopsTableSeeder::class);

        //管理者
        $adminRole = Role::create(['name' => 'admin']);
        //店舗代表者
        $shopRepRole = Role::create(['name' => 'shop_representative']);

        //権限
        $manageUserPermission = Permission::create(['name' => 'manage users']);
        $manageShopsPermission = Permission::create(['name' => 'manage shops']);
        $viewReservationPermission = Permission::create(['name' => 'view reservations']);

        //役割に権限を付与
        $adminRole->givePermissionTo($manageUserPermission, $manageShopsPermission);

        $shopRepRole->givePermissionTo($manageShopsPermission, $viewReservationPermission);


        $adminUser = User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => bcrypt('pppp0000')
        ]);

        $adminUser->assignRole('admin');
    }
}
