<?php

namespace App\Jobs;

use App\Facades\Image;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProfileImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = $this->user->profile_photo_path;
        Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/medium/' . $path), 512);
        Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/small/' . $path), 256);
        Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/tiny/' . $path), 128);
    }
}
