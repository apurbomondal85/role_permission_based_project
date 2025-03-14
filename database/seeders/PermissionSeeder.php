<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
     // Define groups
     public const GROUP_ROLE = 'role';

    public function run(): void
    {
        // Delete old permissions
        Permission::whereNotNull('id')->delete();

        // Get roles
        $adminRole = Role::where('slug', 'super-admin')->first();

        // Seed permissions
        foreach ($this->adminPermissions() as $p) {
            $permission = Permission::create([
                'name'       => $p['name'],
                'slug'       => $p['slug'],
                'group'      => $p['group'],
                'for'        => 'employee',
            ]);

            // Assign all permissions to super-admin
            if ($adminRole) {
                $adminRole->permissions()->attach($permission);
            }
        }
    }

    private function adminPermissions()
    {
        return [
            // Role
            [
                'name' => 'List',
                'slug' => self::GROUP_ROLE . '_index',
                'group' => self::GROUP_ROLE,
            ],
            [
                'name' => 'Create',
                'slug' => self::GROUP_ROLE . '_create',
                'group' => self::GROUP_ROLE,
            ],
            [
                'name' => 'Update',
                'slug' => self::GROUP_ROLE . '_update',
                'group' => self::GROUP_ROLE,
            ],
            [
                'name' => 'Delete',
                'slug' => self::GROUP_ROLE . '_delete',
                'group' => self::GROUP_ROLE,
            ],
        ];
    }
}
