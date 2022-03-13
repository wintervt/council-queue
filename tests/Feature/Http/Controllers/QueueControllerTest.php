<?php

namespace Tests\Feature\Http\Controllers;
use Session;
use App\Models\{
    CustomerType,
    Queue,
    Service
};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class QueueControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Session::start();

        $this->get('/api/queue')
            ->assertStatus(200);

        $service = Service::first();

        $customer_type = CustomerType::where('name', 'Citizen')->first();

        $queue = [
            '_token' => csrf_token(),
            'service_id' => $service->id,
            'customer_type_id' => $customer_type->id,
            'customer_type_name' => $customer_type->name,
            'customer_title' => 'Mr.',
            'customer_first_name' => 'Milan',
            'customer_last_name' => 'Toth',
        ];

        $this->post('/api/queue', $queue)
            ->assertStatus(200);

        $this->assertDatabaseHas('queues', [
            'service_id' => $service->id,
            'customer_type_id' => $customer_type->id,
            'customer_name' => 'Mr. Milan Toth',
        ]);
    }
}
