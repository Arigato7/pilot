<?php

namespace Pilot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveMaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materials:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all user material files.';

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
        $directory = '/public/materials/';
        if (Storage::exists($directory)) {
            $directories = Storage::directories($directory);
            foreach ($directories as $directory) {
                Storage::deleteDirectory($directory);
            }
            $this->info('Users material files are removed.');
        } else {
            $this->error('Can`t find material folder!');
        }
    }
}
