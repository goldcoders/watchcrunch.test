<?php

namespace App\Interfaces;

interface UserInterface
{
    public function all();

    public function find(int $id);

    public function findByName(string $name);

    public function getTopUser(int $postCount);

    public function chunkTopUsers(int $postCount, int $chunkCount);
}
