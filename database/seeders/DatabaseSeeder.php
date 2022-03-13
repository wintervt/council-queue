<?php

namespace Database\Seeders;
use App\Models\ {
    CustomerType,
    Service
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Services Table Seeder
        $services = [
            'Housing',
            'Benefits',
            'Council Tax',
            'Fly-tipping',
            'Missed Bin',
        ];

        if (Service::count() === 0) {
            foreach($services as $service) {
                Service::create(['name' => $service]);
            }
        }

        //Customer Type Table Seeder
        $customer_types = [
            'Citizen',
            'Organisation',
            'Anonymous'
        ];

        if (CustomerType::count() === 0) {
            foreach($customer_types as $customer_type) {
                CustomerType::create(['name' => $customer_type]);
            }
        }

    }
}
