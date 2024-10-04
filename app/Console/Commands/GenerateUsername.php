<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class GenerateUsername extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-username';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random username';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('username', null)->get();
        $users->each(function($user){
            $user->update([
                'username' => Str::random(8)
            ]);
        });


        $this->info("Successfully generate username");
    }
}
