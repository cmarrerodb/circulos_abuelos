<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('TRUNCATE permissions RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE roles RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE users RESTART IDENTITY CASCADE');
        $role1=Role::create(['name' => 'Admin']);
        $role2=Role::create(['name' => 'Transcriptor']);

        Permission::create(['name' => 'admin.circle.create','description' => 'Crear círculo'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.circle.edit','description' => 'Editar círculo'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.circle.destroy','description' => 'Eliminar círculo'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.circle.index','description' => 'Listar círculo'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.circle.view','description' => 'Ver círculo'])->syncRoles([ $role1, $role2 ]);

        Permission::create(['name' => 'admin.participants.create','description' => 'Crear participante'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.participants.edit','description' => 'Editar participante'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.participants.destroy','description' => 'Eliminar participante'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.participants.index','description' => 'Listar participante'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.participants.view','description' => 'Ver participante'])->syncRoles([ $role1, $role2 ]);
        
        Permission::create(['name' => 'admin.roles.update','description' => 'Actualizar rol'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.assign','description' => 'Asignar rol'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.create','description' => 'Crear rol'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.edit','description' => 'Editar roles'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.destroy','description' => 'Eliminar rol'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.index','description' => 'Ver roles'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.roles.store','description' => 'Guardar rol'])->syncRoles([ $role1, $role2 ]);
        
        Permission::create(['name' => 'admin.permissions.update','description' => 'Actualizar permisos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.permissions.create','description' => 'Crear permisos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.permissions.edit','description' => 'Editar permisos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.permissions.destroy','description' => 'Eliminar permisos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.permissions.index','description' => 'Ver permisos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.permissions.store','description' => 'Guardar Permisos'])->syncRoles([ $role1, $role2 ]);
        
        Permission::create(['name' => 'admin.auxiliary.list','description' => 'Módulo auxiliares'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.graphics.list','description' => 'Módulo gráficos'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.reports.list','description' => 'Módulo reportes'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.users.list','description' => 'Módulo usuarios'])->syncRoles([ $role1, $role2 ]);
        Permission::create(['name' => 'admin.workers.list','description' => 'Módulo trabajadores'])->syncRoles([ $role1, $role2 ]);

    }
}
