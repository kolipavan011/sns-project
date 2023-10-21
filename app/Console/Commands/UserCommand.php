<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vidmin:user
                    { --email= : Email associated with the user }
                    { --password= : Password associated with the user }
                    { --name= : name associated with the user }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user for Vidmin';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!filter_var($this->option('email'), FILTER_VALIDATE_EMAIL)) {
            $this->error('Please enter a valid email.');

            return;
        }

        $email = $this->option('email');
        $password = $this->option('password') ?? 'password';
        $name = $this->option('name') ?? 'New User';

        $user = new User();
        $user->fill([
            'id' => Uuid::uuid4()->toString(),
            'email' => $email,
            'name' => $name,
            'password' => Hash::make($password),
        ]);

        $user->save();

        $this->info('New user created.');
        $this->table(['Email', 'Password'], [[$email, $password]]);
        $this->info('Hey ' . $name . ', Let`s login and update your credentials first.');
    }
}
