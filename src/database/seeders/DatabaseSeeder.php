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
        $admin_role = Role::create(['name' => 'admin']);
        //店舗代表者
        $shop_rep_role = Role::create(['name' => 'shop_representative']);

        //権限
        $manage_user_permission = Permission::create(['name' => 'manage users']);
        $manage_shops_permission = Permission::create(['name' => 'manage shops']);
        $view_reservation_permission = Permission::create(['name' => 'view reservations']);

        //役割に権限を付与
        $admin_role->givePermissionTo($manage_user_permission, $manage_shops_permission);

        $shop_rep_role->givePermissionTo($manage_shops_permission, $view_reservation_permission);

        $admin_user = User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => bcrypt('pppp0000'),
            'email_verified_at' => now()
        ]);

        $admin_user->assignRole('admin');
    }
}
