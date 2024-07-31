<?php

namespace Database\Seeders;

use App\Models\Subscriptions\Database;
use App\Models\Subscriptions\Proxy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            Permission::create(['name' => 'view.admin']),
        ]);
        $adminUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $adminUser->assignRole($admin);

        $proxy = Proxy::factory()->create();

        if (app()->environment(['local', 'development'])) {
            $dbContent = file(database_path('seeders/fixtures/tbl_db_list.txt'));
            foreach ($dbContent as $key => $line) {
                if ($key !== 0) {
                    if (empty($line)) {
                        break;
                    }
                    $columns = explode('|', $line);
                    if (! empty($columns[1])) {
                        $database = new Database();
                        // $database->vendor_id = $columns[1];
                        $database->name = $columns[2];
                        $database->url = $columns[4];
                        $database->description = $columns[6];

                        $database->is_public = true;
                        $database->proxy_id = $proxy->id;
                        $database->save();
                        // $database->subjects()->attach($headings->where('jhu_id', $columns[0])->pluck('subject_id'));
                    }
                }
            }
        }

    }
}
