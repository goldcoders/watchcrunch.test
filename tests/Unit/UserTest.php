<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepositories;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = app(UserRepositories::class);

        $this->artisan('db:seed');
    }

    public function test_if_return_data_has_the_required_keys()
    {
        $postCount = 10;
        $topUsers = $this->userRepository->getTopUser($postCount)->get();
        $this->assertArrayHasKey('username', $topUsers->toArray()[0]);
        $this->assertArrayHasKey('total_posts_count', $topUsers->toArray()[0]);
        $this->assertArrayHasKey('last_post_title', $topUsers->toArray()[0]);
    }

    public function test_if_top_post_return_latest_post_title()
    {
        $postCount = 10;
        $topUsers =$this->userRepository->getTopUser($postCount)->get();
        $topUser  = $topUsers->first();
        $username = $topUser->username;

        $user       = User::findByName($username);
        $latestpost = $user->posts->last();

        $this->assertEquals($latestpost->title, $topUser->last_post_title);
        // check if the total_posts_count > 10 which is the  limit
        $this->assertGreaterThan(10, $topUser->total_posts_count);
    }
    public function test_should_return_correct_number_of_top_users()
    {
        $postCount = 10;
        $topUsersCount =count($this->userRepository->getTopUser($postCount)->get());
        // exact number of users with post greater than 10 in the last 7 days = 10
        // this is set on our db seed
        $this->assertEquals(10, $topUsersCount);
    }

    public function test_if_users_data_are_seeded()
    {
        $count = User::count();
        // total users in our db seed = 20
        $this->assertEquals(20, $count);
    }
}
