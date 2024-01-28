<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'team_create',
            ],
            [
                'id'    => 19,
                'title' => 'team_edit',
            ],
            [
                'id'    => 20,
                'title' => 'team_show',
            ],
            [
                'id'    => 21,
                'title' => 'team_delete',
            ],
            [
                'id'    => 22,
                'title' => 'team_access',
            ],
            [
                'id'    => 23,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 24,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 25,
                'title' => 'textifyi_number_create',
            ],
            [
                'id'    => 26,
                'title' => 'textifyi_number_edit',
            ],
            [
                'id'    => 27,
                'title' => 'textifyi_number_show',
            ],
            [
                'id'    => 28,
                'title' => 'textifyi_number_delete',
            ],
            [
                'id'    => 29,
                'title' => 'textifyi_number_access',
            ],
            [
                'id'    => 30,
                'title' => 'client_create',
            ],
            [
                'id'    => 31,
                'title' => 'client_edit',
            ],
            [
                'id'    => 32,
                'title' => 'client_show',
            ],
            [
                'id'    => 33,
                'title' => 'client_delete',
            ],
            [
                'id'    => 34,
                'title' => 'client_access',
            ],
            [
                'id'    => 35,
                'title' => 'keyword_create',
            ],
            [
                'id'    => 36,
                'title' => 'keyword_edit',
            ],
            [
                'id'    => 37,
                'title' => 'keyword_show',
            ],
            [
                'id'    => 38,
                'title' => 'keyword_delete',
            ],
            [
                'id'    => 39,
                'title' => 'keyword_access',
            ],
            [
                'id'    => 40,
                'title' => 'text_response_create',
            ],
            [
                'id'    => 41,
                'title' => 'text_response_edit',
            ],
            [
                'id'    => 42,
                'title' => 'text_response_show',
            ],
            [
                'id'    => 43,
                'title' => 'text_response_delete',
            ],
            [
                'id'    => 44,
                'title' => 'text_response_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
