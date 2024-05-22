<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
         * You may discover that it is best to flush this package's cache before seeding, to avoid cache conflict errors.
         */
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $data = config('permission_data');
        if (empty($data) || !is_array($data)) return;
        PermissionGroup::query()->update(['status' => false]);
        Permission::query()->update(['status' => false]);

        $groupIndex = 0;
        foreach ($data as $slugGroup => $group) {
            $groupIndex++;
            $permissionGroup = PermissionGroup::where('key', $slugGroup)->first();
            if (!$permissionGroup) {
                $permissionGroup = PermissionGroup::create([
                    'name' => $group['title'],
                    'key' => $slugGroup,
                    'sorting' => $groupIndex
                ]);
            } else {
                $permissionGroup->update([
                    'sorting' => $groupIndex,
                    'status' => true
                ]);
            }
            foreach ($group['permissions'] as $permissionKey => $permissionTitle) {
                $permission = Permission::where(
                    [
                        'name' => $permissionKey,
                        'guard_name' => 'web',
                    ]
                )->first();

                if (!$permission) {
                    Permission::create([
                        'name' => $permissionKey,
                        'title' => $permissionTitle,
                        'permission_group_id' => $permissionGroup->id,
                        'guard_name' => 'web',
                    ]);
                } else {
                    $permission->update([
                        'status' => true
                    ]);
                }
            }
        }

    }
}
