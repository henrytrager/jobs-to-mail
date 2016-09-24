<?php namespace JobApis\JobsToMail\Tests\Integration;

use JobApis\JobsToMail\Tests\TestCase;
use JobApis\JobsToMail\Models\User;

class UserModelTest extends TestCase
{
    public function testItGeneratesUuidUponCreation()
    {
        $email = $this->faker->email();
        $user = User::create([
            'email' => $email,
            'keyword' => uniqid(),
            'location' => uniqid(),
        ]);
        $this->assertNotNull($user->id);
        $this->assertEquals($email, $user->email);
    }

    public function testItCanGetAssociatedModelToken()
    {
        $user = User::with('tokens')->first();
        foreach ($user->tokens as $token) {
            $this->assertEquals($token->user_id, $user->id);
        }

    }
}