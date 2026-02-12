<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Define Permissions
        $permissions = [
            'manage_clinic_settings',
            'manage_staff',
            'view_financial_reports',
            'create_appointment',
            'edit_appointment',
            'cancel_appointment',
            'view_patient_profile',
            'view_medical_records',
            'create_prescription',
            'view_doctor_schedule',
        ];

        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName], ['guard_name' => 'web']);
        }

        // 2. Define Roles and their Permissions
        $rolesData = [
            'medical_center_admin' => [
                'manage_clinic_settings',
                'manage_staff',
                'view_financial_reports',
                'create_appointment',
                'edit_appointment',
                'cancel_appointment',
                'view_patient_profile',
                'view_medical_records',
                'create_prescription',
                'view_doctor_schedule',
            ],
            'clinic_manager' => [
                'manage_clinic_settings',
                'manage_staff',
                'create_appointment',
                'edit_appointment',
                'cancel_appointment',
                'view_patient_profile',
                'view_medical_records',
                'view_doctor_schedule',
            ],
            'receptionist' => [
                'create_appointment',
                'edit_appointment',
                'cancel_appointment',
                'view_patient_profile',
                'view_doctor_schedule',
            ],
            'doctor' => [
                'view_patient_profile',
                'view_medical_records',
                'create_prescription',
                'view_doctor_schedule',
            ],
        ];

        foreach ($rolesData as $roleName => $permissionNames) {
            $role = Role::updateOrCreate(['name' => $roleName], ['guard_name' => 'web']);

            $permissionIds = Permission::whereIn('name', $permissionNames)->pluck('id');
            $role->permissions()->sync($permissionIds);
        }
    }
}
