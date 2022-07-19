<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(FeeshipSeeder::class);


		// DB::table('users')->insert([
		// 	[
		// 		'name' => 'admin',
		// 		'email' => 'admin@gmail.com',
		// 		'password' => bcrypt('123456'),
		// 		'created_at' => now(),
		// 		'updated_at' => now(),
		// 		'email_verified_at' => now(),
		// 	],
		// 	[
		// 		'name' => 'user',
		// 		'email' => 'user@gmail.com',
		// 		'password' => bcrypt('123456'),
		// 		'created_at' => now(),
		// 		'updated_at' => now(),
		// 		'email_verified_at' => now(),
		// 	],
		// ]);

		// DB::table('roles')->insert([
		// 	['name' => 'admin', 'display_name' => 'admin'],
		// 	['name' => 'user', 'display_name' => 'user'],
		// ]);

		
		// DB::table('permissions')->insert([
		// 	['name' => 'category','display_name' => 'view-cate','parent_id' => 0 ,'key_code' => 'category'],
		// 	['name' => 'view','display_name' => 'view-cate','parent_id' => 1 ,'key_code' => 'category_view'],
		// 	['name' => 'update','display_name' => 'update-cate','parent_id' => 1 ,'key_code' => 'category_update'],
		// 	['name' => 'delete','display_name' => 'delete-cate','parent_id' => 1 ,'key_code' => 'category_delete'],
		// 	['name' => 'list','display_name' => 'list-cate','parent_id' => 1 ,'key_code' => 'category_list']
		// ]);
		

		// DB::table('role_users')->insert([
		// 	'user_id' => 1,
		// 	'role_id' => 1,
		// ]);


		// DB::table('permission_roles')->insert([
		// 	['permission_id' => 1, 'role_id' => 1],
		// 	['permission_id' => 2, 'role_id' => 1],
		// 	['permission_id' => 3, 'role_id' => 1],
		// 	['permission_id' => 4, 'role_id' => 1],
		// ]);
		
    }
}
