<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreQueueRequest;
use App\Models\ {
    CustomerType,
    Queue,
    Service
};
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index(Request $request)
    {
        $customer_types = CustomerType::all();
        $services = Service::all();
        $queues = Queue::with('service', 'customer_type')->orderBy('created_at', 'ASC')->get();

        if( $request->ajax() ) {
            return response()->json([
                'queues' => $queues,
                'services' => $services,
                'customer_types' => $customer_types
            ]);
        }
    }

    public function store(StoreQueueRequest $request) {
        $validated = $request->validated();

        switch($validated['customer_type_name']) {
            case 'Citizen':
                $customer_name = $validated['customer_title'] . " " . $validated['customer_first_name'] . " " . $validated['customer_last_name'];
            break;
            case 'Organisation':
                $customer_name = $validated['customer_organisation_name'];
            break;
            default:
                $customer_name = 'Anonymous';
            break;
        }

        $new_queue = Queue::create([
            'service_id' => $validated['service_id'],
            'customer_type_id' => $validated['customer_type_id'],
            'customer_name' => $customer_name,
        ]);

        return response()->json([
            'message' => "Customer successfully added to the queue - #{$new_queue->id}"
        ]);
    }



}
