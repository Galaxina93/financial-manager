<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // ===================================================================
        // TEIL 1: ROLLEN UND BERECHTIGUNGEN ERSTELLEN
        // ===================================================================

        // 1. Rollen erstellen oder laden
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // 2. Alle Berechtigungen definieren
        $permissions = [
            'manage_admins', 'manage_admin_profiles', 'manage_customers',
            'manage_employees', 'manage_roles', 'delete_account'
        ];

        // 3. Alle Berechtigungen erstellen oder laden
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // 4. Berechtigungen den Rollen zuweisen
        $adminRole->permissions()->sync(Permission::all());
        $customerRole->permissions()->sync(Permission::where('name', 'delete_account')->first());
        $employeeRole->permissions()->sync(Permission::where('name', 'delete_account')->first());


        // ===================================================================
        // TEIL 2: BENUTZER ERSTELLEN UND IHNEN ROLLEN ZUWEISEN
        // ===================================================================

        // 5. Admin-Benutzer erstellen und die Admin-Rolle zuweisen
        $admin = Admin::firstOrCreate(
            ['email' => 'info@felix-machts.com'], // Prüfen, ob der Admin schon existiert
            [ // Daten, falls er neu erstellt wird
                'first_name' => 'Felix',
                'last_name' => 'Machts',
                'password' => Hash::make('FelixMachts.!*'),
            ]
        );
        // Die entscheidende Zeile, die den Benutzer mit der Rolle verknüpft:
        $admin->roles()->sync($adminRole->id);

        // 6. Kunden-Benutzer erstellen und die Kunden-Rolle zuweisen
        $customer = Customer::firstOrCreate(
            ['email' => 'kunde@felix-machts.com'],
            [
                'first_name' => 'Kunde',
                'last_name' => 'Machts',
                'password' => Hash::make('FelixMachts.!*'),
            ]
        );
        $customer->roles()->sync($customerRole->id);

        // 7. Mitarbeiter-Benutzer erstellen und die Mitarbeiter-Rolle zuweisen
        $employee = Employee::firstOrCreate(
            ['email' => 'mitarbeiter@felix-machts.com'],
            [
                'first_name' => 'Mitarbeiter',
                'last_name' => 'Machts',
                'password' => Hash::make('FelixMachts.!*'),
            ]
        );
        $employee->roles()->sync($employeeRole->id);
    }
}
