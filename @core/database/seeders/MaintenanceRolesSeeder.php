<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MaintenanceRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إنشاء الأدوار الجديدة
        $roles = [
            'Support Agent',
            'Technician',
            'Client',
            'Quality Agent',
            'Finance'
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);
        }

        // إنشاء الصلاحيات الأساسية
        $permissions = [
            // Support permissions
            'view support dashboard',
            'manage orders',
            'assign technicians',
            'export orders',
            
            // Technician permissions
            'view technician dashboard',
            'view assigned orders',
            'accept orders',
            'reject orders',
            'update order status',
            
            // Client permissions
            'view client dashboard',
            'create orders',
            'view own orders',
            'track orders',
            'view invoices',
            'view warranties',
            
            // Quality permissions
            'view quality dashboard',
            'create quality followups',
            'update quality followups',
            'view quality reports',
            
            // Finance permissions
            'view finance dashboard',
            'view invoices',
            'update payment status',
            'view financial reports',
            'view statistics',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web'
            ]);
        }

        // تعيين الصلاحيات للأدوار
        $supportRole = Role::where('name', 'Support Agent')->first();
        if ($supportRole) {
            $supportRole->givePermissionTo([
                'view support dashboard',
                'manage orders',
                'assign technicians',
                'export orders',
            ]);
        }

        $technicianRole = Role::where('name', 'Technician')->first();
        if ($technicianRole) {
            $technicianRole->givePermissionTo([
                'view technician dashboard',
                'view assigned orders',
                'accept orders',
                'reject orders',
                'update order status',
            ]);
        }

        $clientRole = Role::where('name', 'Client')->first();
        if ($clientRole) {
            $clientRole->givePermissionTo([
                'view client dashboard',
                'create orders',
                'view own orders',
                'track orders',
                'view invoices',
                'view warranties',
            ]);
        }

        $qualityRole = Role::where('name', 'Quality Agent')->first();
        if ($qualityRole) {
            $qualityRole->givePermissionTo([
                'view quality dashboard',
                'create quality followups',
                'update quality followups',
                'view quality reports',
            ]);
        }

        $financeRole = Role::where('name', 'Finance')->first();
        if ($financeRole) {
            $financeRole->givePermissionTo([
                'view finance dashboard',
                'view invoices',
                'update payment status',
                'view financial reports',
                'view statistics',
            ]);
        }

        // Super Admin و Admin لديهم جميع الصلاحيات
        $superAdminRole = Role::where('name', 'Super Admin')->where('guard_name', 'admin')->first();
        $adminRole = Role::where('name', 'Admin')->where('guard_name', 'admin')->first();
        
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo(Permission::where('guard_name', 'web')->get());
        }
        
        if ($adminRole) {
            $adminRole->givePermissionTo(Permission::where('guard_name', 'web')->get());
        }
    }
}

