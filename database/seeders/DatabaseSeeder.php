<?php

namespace Database\Seeders;

use App\Models\Subscriptions\Database;
use App\Models\Subscriptions\Proxy;
use App\Models\Subscriptions\Vendor;
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
            $dbVendors = file(database_path('seeders/fixtures/tbl_dict_vendors.txt'));
            $vendors = collect();
            foreach ($dbVendors as $key => $line) {
                if ($key !== 0) {
                    if (empty($line)) {
                        break;
                    }
                    $columns = explode('|', $line);
                    $vendors->push([
                        'id' => $columns[0],
                        'name' => $columns[1],
                    ]);
                    if (! empty($columns[0])) {
                        $vendor = new \App\Models\Subscriptions\Vendor();
                        $vendor->name = $columns[1];
                        $vendor->save();
                    }
                }
            }
            $dbContent = file(database_path('seeders/fixtures/tbl_db_list.txt'));
            foreach ($dbContent as $key => $line) {
                if ($key !== 0) {
                    if (empty($line)) {
                        break;
                    }
                    $columns = explode('|', $line);
                    if (! empty($columns[1])) {
                        $database = new Database();
                        $database->vendor_id = Vendor::firstWhere(
                            'name',
                            $vendors->firstWhere('id', $columns[1])['name'] ?? null)
                            ?->id;
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
            $subjects = [
                'Engineering' => [
                    'Civil Engineering',
                    'Computer Engineering',
                    'Electrical Engineering',
                    'Mechanical Engineering',
                ],
                'Health Sciences' => [
                    'Nursing',
                    'Public Health',
                    'Rehabilitation Sciences',
                    'Social Work',
                ],
            ];
            foreach ($subjects as $parent => $children) {
                $parentSubject = new \App\Models\Subscriptions\Subject();
                $parentSubject->name = $parent;
                $parentSubject->save();
                foreach ($children as $child) {
                    $childSubject = new \App\Models\Subscriptions\Subject();
                    $childSubject->name = $child;
                    $childSubject->parent_id = $parentSubject->id;
                    $childSubject->save();
                }
            }

            $formats = [
                'Abstract / Citation / Index',
                'Audio',
                'eBooks',
                'Full-Text Articles',
                'Government Documents',
                'Images',
                'Journals',
                'Maps',
                'Musical Scores',
                'Newspapers',
                'Primary Resources',
                'Reference',
                'Reports / Data',
                'Statistics',
                'Video',
            ];
            foreach ($formats as $format) {
                $formatModel = new \App\Models\Subscriptions\Format();
                $formatModel->name = $format;
                $formatModel->save();
            }
        }

    }
}
