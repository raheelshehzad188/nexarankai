<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdminPassword extends Command
{
    protected $signature = 'admin:reset-password 
                            {email? : Admin email address}
                            {password? : New password}';

    protected $description = 'Reset admin user password by email';

    public function handle(): int
    {
        $email = $this->argument('email') ?? $this->ask('Admin email?');
        $password = $this->argument('password') ?? $this->secret('New password?');

        if (empty($email) || empty($password)) {
            $this->error('Email and password are required.');
            return 1;
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");

            if ($this->confirm('Create new admin user with this email?', true)) {
                $user = User::create([
                    'name' => 'Admin',
                    'email' => $email,
                    'password' => $password,
                ]);
                $this->info("Admin user created. Email: {$email}");
            }
            return $user ? 0 : 1;
        }

        $user->password = $password;
        $user->save();

        $this->info("Password reset successful for {$email}");
        $this->info('You can now login at /admin/login');

        return 0;
    }
}
