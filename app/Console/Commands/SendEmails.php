<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:run {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command run.....';

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
       $data['email'] =$this->argument('email');
       $data['name'] =$this->argument('email');
       $data['password'] =bcrypt($this->argument('email'));
       $already = \App\User::where('email',$data['email'])->count();
       
       $user = \App\User::findOrFail($data['email']);
       echo $user['name'];
       /*if($already == 0){
            $userCreate = \App\User::create($data);
            echo "User created successfully.";
       }else{
            
            echo "Already exists";
       }*/
       
    }
}
