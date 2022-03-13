<?php

namespace App\Http\Controllers;
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
        else {
            return view('app.index');
        }

    }

}
