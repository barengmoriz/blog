<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-superadmin {username?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command set role Super Admin by username';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');

        if(!$username) {
            $username = $this->ask('Silahkan masukkan nama pengguna');   
        }

        $user = User::where('username', $username)->first();
        if($user){
            $user->assignRole('Super Admin');
            $this->info("Saat ini {$user->name} ({$user->username}) adalah Super Admin");
        } else {
            $this->info("Nama pengguna {$username} tidak dapat ditemukan");
        }
    }
}
