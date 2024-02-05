<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RehashPasswords extends Command
{
    protected $signature = 'passwords:rehash';

    protected $description = 'Rehash passwords using Bcrypt algorithm';

    public function handle()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $hashedPassword = Hash::make($user->password);
            DB::table('users')->where('id', $user->id)->update(['password' => $hashedPassword]);
        }

        $this->info('Passwords rehashed successfully.');
    }
}
