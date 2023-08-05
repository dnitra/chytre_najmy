<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreatePropertyTest extends TestCase
{
    use RefreshDatabase;
    public function test_properties_can_be_created(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $response = $this->post('/owner-portal/my-properties', [
            'property_type_id' => 1,
            'city' => 'Test City',
            'country_id' => 1,
            'street_and_number' => 'Test Street 1',
            'zip_code' => '12345',
        ]);

        $this->assertDatabaseHas('addresses', [
            'city' => 'Test City',
            'country_id' => 1,
            'street_and_number' => 'Test Street 1',
            'zip_code' => '12345',
        ]);
        $this->assertEquals(1, $user->fresh()->properties()->latest('id')->first()->property_type_id);
        $this->assertEquals(1, $user->fresh()->properties()->latest('id')->first()->address_id);
        $response->assertRedirect('/owner-portal/my-properties/1');
    }

//    public function test_properties_can_be_created_with_validation_errors(): void
//    {
//
//    }
}
