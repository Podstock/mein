<?php

namespace App\Console\Commands;

use App\Models\BaresipWebrtc;
use Illuminate\Console\Command;

class WebrtcListen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webrtc:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        BaresipWebrtc::listen();
        return 0;
    }
}
