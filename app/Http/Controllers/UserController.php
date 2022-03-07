<?php

namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Jobs\ProcessChunkTopUsers;

class UserController extends Controller
{
    protected UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getTopUsers(int $postCount = 10)
    {
        return $this->userRepository->getTopUser($postCount)->get()->toJson();
    }

    public function chunkTopUsers(int $postCount = 10, int $chunkCount = 1000)
    {
        return $this->userRepository->chunkTopUsers($postCount, $chunkCount);
    }

    public function queuedChunkTopUsers(int $postCount = 10, int $chunkCount = 1000)
    {
        ProcessChunkTopUsers::dispatch($this->userRepository,$postCount, $chunkCount);
        return 'We are processing to Cache the Data, check this Link later:' . env('APP_URL') . '/chunk-top-users/' . $postCount . '/' . $chunkCount . ' for results';
    }
}
