<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CreateTestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Creating Test Users for All Roles ===');
        $this->command->info('');

        // إنشاء الأدوار أولاً إذا لم تكن موجودة
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

        $this->command->info('✓ Roles created/verified');
        $this->command->info('');

        // قائمة المستخدمين لكل دور
        $users = [
            [
                'name' => 'Support Agent',
                'username' => 'support',
                'email' => 'support@syanteck.com',
                'phone' => '0500000001',
                'password' => '12345678',
                'role' => 'Support Agent',
                'user_type' => 0,
                'user_status' => 1,
                'email_verified' => 1,
            ],
            [
                'name' => 'Technician',
                'username' => 'technician',
                'email' => 'technician@syanteck.com',
                'phone' => '0500000002',
                'password' => '12345678',
                'role' => 'Technician',
                'user_type' => 0,
                'user_status' => 1,
                'email_verified' => 1,
                'is_available' => true,
            ],
            [
                'name' => 'Client',
                'username' => 'client',
                'email' => 'client@syanteck.com',
                'phone' => '0500000003',
                'password' => '12345678',
                'role' => 'Client',
                'user_type' => 1,
                'user_status' => 1,
                'email_verified' => 1,
            ],
            [
                'name' => 'Quality Agent',
                'username' => 'quality',
                'email' => 'quality@syanteck.com',
                'phone' => '0500000004',
                'password' => '12345678',
                'role' => 'Quality Agent',
                'user_type' => 0,
                'user_status' => 1,
                'email_verified' => 1,
            ],
            [
                'name' => 'Finance',
                'username' => 'finance',
                'email' => 'finance@syanteck.com',
                'phone' => '0500000005',
                'password' => '12345678',
                'role' => 'Finance',
                'user_type' => 0,
                'user_status' => 1,
                'email_verified' => 1,
            ],
        ];

        foreach ($users as $userData) {
            $roleName = $userData['role'];
            unset($userData['role']);

            // التحقق من وجود المستخدم
            $user = User::where('email', $userData['email'])
                ->orWhere('username', $userData['username'])
                ->first();

            if ($user) {
                // تحديث المستخدم الموجود
                $userData['password'] = Hash::make($userData['password']);
                $user->update($userData);
                $this->command->info("✓ Updated user: {$userData['name']} ({$userData['email']})");
            } else {
                // إنشاء مستخدم جديد
                $userData['password'] = Hash::make($userData['password']);
                $user = User::create($userData);
                $this->command->info("✓ Created user: {$userData['name']} ({$userData['email']})");
            }

            // تعيين الدور
            $role = Role::where('name', $roleName)->where('guard_name', 'web')->first();
            if ($role) {
                $user->assignRole($role);
                $this->command->info("  → Assigned role: {$roleName}");
            } else {
                $this->command->warn("  ⚠ Role not found: {$roleName}");
            }
        }

        $this->command->info('');
        $this->command->info('=== Login Credentials ===');
        $this->command->info('');
        $this->command->info('Support Agent:');
        $this->command->info('  URL: /login/support');
        $this->command->info('  Username: support');
        $this->command->info('  Password: 12345678');
        $this->command->info('');
        $this->command->info('Technician:');
        $this->command->info('  URL: /login/technician');
        $this->command->info('  Username: technician');
        $this->command->info('  Password: 12345678');
        $this->command->info('');
        $this->command->info('Client:');
        $this->command->info('  URL: /login/client');
        $this->command->info('  Username: client');
        $this->command->info('  Password: 12345678');
        $this->command->info('');
        $this->command->info('Quality Agent:');
        $this->command->info('  URL: /login/quality');
        $this->command->info('  Username: quality');
        $this->command->info('  Password: 12345678');
        $this->command->info('');
        $this->command->info('Finance:');
        $this->command->info('  URL: /login/finance');
        $this->command->info('  Username: finance');
        $this->command->info('  Password: 12345678');
        $this->command->info('');
        $this->command->info('✓ All test users created successfully!');
    }
}
