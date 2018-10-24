<?php

namespace VoceCrianca\Console\Commands;

use Illuminate\Console\Command;
use VoceCrianca\Models\User;

class RemoveTokenResetPasswordUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:token-pw-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove user password recovery token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $users = User::select('tokenResetPassword')->where(
            'tokenResetPassword.time', '<=', time()
        )->get();

        if($users) {
            foreach ($users as $key => $user) {
                $user->tokenResetPassword()->delete();
            }
        }
    }
}
