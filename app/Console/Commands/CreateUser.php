<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name  = getenv('CHANGE_PASSWORD_NAME');
        $email  = getenv('CHANGE_PASSWORD_EMAIL');
        User::factory()->create([
            'name' => $name,
            'email' => $email,
            'ministry_id' => 1
        ]);
    }
}
