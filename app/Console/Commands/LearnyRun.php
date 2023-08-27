<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;

class LearnyRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'learny:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to make database and run it for you';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $this->info('==========================================');
        $this->info('Task 1: create database');
        $envFilePath = base_path('.env');
        $databaseName = 'learny';
        $key = 'DB_DATABASE';
        $value = $databaseName;
        if (File::exists($envFilePath)) {
            $envFile = File::get($envFilePath);
            $envFile = preg_replace("/^$key=.*$/m", "$key=$value", $envFile);
            File::put($envFilePath, $envFile);
        } else {
            $this->error('.env file not found!');
        }
        sleep(2);
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');
        $query = "CREATE DATABASE IF NOT EXISTS $databaseName CHARACTER SET $charset COLLATE $collation";
        DB::statement($query);
        $this->info('Task 1 : done');
        $this->info('==========================================');

        $this->info('==========================================');
        $this->info('Task 2 : Migrate tables');
        $this->call('migrate:fresh');
        $this->info('Task 2 : done');
        $this->info('==========================================');

        $this->info('==========================================');
        $this->info('Task 3 : Create seed');
        $this->call('db:seed');
        $this->info('Task 3 : done');
        $this->info('==========================================');

        $this->info('==========================================');
        $this->info('Task 4 : Create Client ID');
        $this->call('passport:client',['--personal'=>true, '--name'=>'learny']);
        $this->info('Task 4 : done');
        $this->info('==========================================');

        $this->info('==========================================');
        $this->info('Task 5 : Run server');
        $this->call('serve');
    }
}
