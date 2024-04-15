<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteSignatureImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-signature-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = storage_path('app/public');
        $files = scandir($dir);
        foreach($files as $file){
            if($file != '.' && $file != '..' && $file != '.gitignore') {
                unlink($dir.'/'.$file);
            }
        }
    }
}
