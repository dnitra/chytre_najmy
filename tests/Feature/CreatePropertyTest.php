<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreatePropertyTest extends TestCase
{

    public function test_properties_can_be_created(): void
    {
//        $this->actingAs($user = User::factory()->withPersonalTeam()->create());
//
//        $response = $this->post('/myproperties', [
//            'name' => 'Test Property',
//            'address' => 'Test Address',
//            'type' => 1,
//        ]);
//
//        $this->assertCount(1, $user->fresh()->ownedTeams);
//        $this->assertEquals('Test Property', $user->fresh()->properties()->latest('id')->first()->name);
//        $this->assertEquals('Test Address', $user->fresh()->properties()->latest('id')->first()->address);
//        $this->assertEquals(1, $user->fresh()->properties()->latest('id')->first()->type);
    }
}
