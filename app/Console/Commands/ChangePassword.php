<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email  = getenv('CHANGE_PASSWORD_EMAIL');
        $usuario = User::where('email', $email)->first();
        $password  = getenv('CHANGE_PASSWQRD_PASSWORD');
        $usuario->password = bcrypt($password);
        $usuario->update();
    }
}
