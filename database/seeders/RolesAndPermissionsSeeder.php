<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $abogadoAdmin = Role::create(['name' => 'abogado admin']);
        $abogado = Role::create(['name' => 'abogado']);
        $arrendador = Role::create(['name' => 'arrendador']);
        $arrendatario = Role::create(['name' => 'arrendatario']);
        $solidario = Role::create(['name' => 'solidario']);
        $fiador = Role::create(['name' => 'fiador']);

        Permission::create(['name' => 'meetings.index'])->syncRoles([$abogadoAdmin, $abogado, $arrendador, $arrendatario]);
        Permission::create(['name' => 'meetings.store'])->syncRoles([$abogadoAdmin]);
        Permission::create(['name' => 'meetings.show'])->syncRoles([$abogadoAdmin, $abogado, $arrendador, $arrendatario]);
        Permission::create(['name' => 'meetings.update'])->syncRoles([$abogadoAdmin]);
        Permission::create(['name' => 'meetings.destroy'])->syncRoles([$abogadoAdmin]);
    }
}
