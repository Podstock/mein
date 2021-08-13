<?php

namespace App\Console\Commands;

use App\Facades\Image;
use App\Models\Camping;
use App\Models\Tent;
use Illuminate\Console\Command;

class BuildTents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:tents';

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
        $tents = Tent::all();

        foreach ($tents as $tent) {
            $number = sprintf("%04d", $tent->number);
            $this->info("Zelt $number");
            Image::resize_copy(
                storage_path('/app/public/' . $tent->user?->projects->first()->logo),
                "/tmp/zelte/output$number.png",
                32
            );
        }

        return 0;
    }
}
