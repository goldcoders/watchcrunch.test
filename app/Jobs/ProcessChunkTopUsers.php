<?php

namespace App\Jobs;

use App\Interfaces\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessChunkTopUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public UserInterface $userRepository;

    public int $postCount;

    public int $chunkCount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository, int $postCount, int $chunkCount)
    {
        $this->userRepository = $userRepository;
        $this->postCount       = $postCount;
        $this->chunkCount      = $chunkCount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->userRepository->chunkTopUsers($this->postCount, $this->chunkCount);
    }
}
