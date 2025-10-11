<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo form
        $form = Form::create([
            'name' => 'Vendor Registration Form',
            'description' => 'A comprehensive form for vendor registration and information collection',
            'slug' => 'vendor-registration',
            'is_active' => true,
        ]);

        // Add some demo fields
        $fields = [
            [
                'name' => 'company_name',
                'label' => 'Company Name',
                'type' => 'text',
                'description' => 'Enter your company or business name',
                'is_required' => true,
                'sort_order' => 0,
            ],
            [
                'name' => 'contact_email',
                'label' => 'Contact Email',
                'type' => 'email',
                'description' => 'Primary email address for communication',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'phone_number',
                'label' => 'Phone Number',
                'type' => 'text',
                'description' => 'Primary contact phone number',
                'is_required' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'business_type',
                'label' => 'Business Type',
                'type' => 'select',
                'description' => 'Select your business category',
                'is_required' => true,
                'options' => ['Manufacturing', 'Retail', 'Service', 'Technology', 'Healthcare', 'Other'],
                'sort_order' => 3,
            ],
            [
                'name' => 'years_in_business',
                'label' => 'Years in Business',
                'type' => 'number',
                'description' => 'How many years has your business been operating?',
                'is_required' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'description',
                'label' => 'Business Description',
                'type' => 'textarea',
                'description' => 'Brief description of your business and services',
                'is_required' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'services',
                'label' => 'Services Offered',
                'type' => 'checkbox',
                'description' => 'Select all services you provide',
                'is_required' => false,
                'options' => ['Consulting', 'Manufacturing', 'Distribution', 'Support', 'Training', 'Custom Solutions'],
                'sort_order' => 6,
            ],
            [
                'name' => 'established_date',
                'label' => 'Established Date',
                'type' => 'date',
                'description' => 'When was your business established?',
                'is_required' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($fields as $fieldData) {
            $form->fields()->create($fieldData);
        }

        $this->command->info('Demo form created successfully!');
    }
}
