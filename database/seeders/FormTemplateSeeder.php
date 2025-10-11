<?php

namespace Database\Seeders;

use App\Models\FormTemplate;
use Illuminate\Database\Seeder;

class FormTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Contact Form',
                'description' => 'A simple contact form for collecting visitor inquiries and feedback.',
                'category' => 'contact',
                'icon' => 'contact',
                'fields_data' => [
                    [
                        'name' => 'name',
                        'label' => 'Full Name',
                        'type' => 'text',
                        'is_required' => true,
                        'description' => 'Enter your full name'
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true,
                        'description' => 'We will use this to respond to your inquiry'
                    ],
                    [
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'type' => 'text',
                        'is_required' => false,
                        'description' => 'Optional phone number'
                    ],
                    [
                        'name' => 'subject',
                        'label' => 'Subject',
                        'type' => 'text',
                        'is_required' => true,
                        'description' => 'Brief description of your inquiry'
                    ],
                    [
                        'name' => 'message',
                        'label' => 'Message',
                        'type' => 'textarea',
                        'is_required' => true,
                        'description' => 'Please provide details about your inquiry'
                    ]
                ]
            ],
            [
                'name' => 'Customer Survey',
                'description' => 'Comprehensive customer satisfaction survey with rating questions.',
                'category' => 'survey',
                'icon' => 'survey',
                'fields_data' => [
                    [
                        'name' => 'customer_name',
                        'label' => 'Customer Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true
                    ],
                    [
                        'name' => 'satisfaction_rating',
                        'label' => 'Overall Satisfaction',
                        'type' => 'select',
                        'is_required' => true,
                        'options' => ['Very Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very Dissatisfied']
                    ],
                    [
                        'name' => 'service_quality',
                        'label' => 'Service Quality Rating',
                        'type' => 'select',
                        'is_required' => true,
                        'options' => ['Excellent', 'Good', 'Average', 'Poor', 'Very Poor']
                    ],
                    [
                        'name' => 'recommendation',
                        'label' => 'Would you recommend us?',
                        'type' => 'radio',
                        'is_required' => true,
                        'options' => ['Yes', 'No', 'Maybe']
                    ],
                    [
                        'name' => 'improvements',
                        'label' => 'Suggestions for Improvement',
                        'type' => 'textarea',
                        'is_required' => false,
                        'description' => 'Any suggestions to help us improve our service'
                    ]
                ]
            ],
            [
                'name' => 'Event Registration',
                'description' => 'Complete event registration form with attendee information.',
                'category' => 'registration',
                'icon' => 'registration',
                'fields_data' => [
                    [
                        'name' => 'first_name',
                        'label' => 'First Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'last_name',
                        'label' => 'Last Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true
                    ],
                    [
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'company',
                        'label' => 'Company/Organization',
                        'type' => 'text',
                        'is_required' => false
                    ],
                    [
                        'name' => 'dietary_requirements',
                        'label' => 'Dietary Requirements',
                        'type' => 'checkbox',
                        'is_required' => false,
                        'options' => ['Vegetarian', 'Vegan', 'Gluten-Free', 'Halal', 'Kosher', 'No Restrictions']
                    ],
                    [
                        'name' => 'emergency_contact',
                        'label' => 'Emergency Contact Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'emergency_phone',
                        'label' => 'Emergency Contact Phone',
                        'type' => 'text',
                        'is_required' => true
                    ]
                ]
            ],
            [
                'name' => 'Product Feedback',
                'description' => 'Collect detailed feedback about products and services.',
                'category' => 'feedback',
                'icon' => 'feedback',
                'fields_data' => [
                    [
                        'name' => 'customer_name',
                        'label' => 'Your Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true
                    ],
                    [
                        'name' => 'product_name',
                        'label' => 'Product Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'purchase_date',
                        'label' => 'Purchase Date',
                        'type' => 'date',
                        'is_required' => true
                    ],
                    [
                        'name' => 'rating',
                        'label' => 'Product Rating',
                        'type' => 'select',
                        'is_required' => true,
                        'options' => ['5 Stars - Excellent', '4 Stars - Very Good', '3 Stars - Good', '2 Stars - Fair', '1 Star - Poor']
                    ],
                    [
                        'name' => 'likes',
                        'label' => 'What did you like?',
                        'type' => 'textarea',
                        'is_required' => false,
                        'description' => 'Tell us what you liked about the product'
                    ],
                    [
                        'name' => 'dislikes',
                        'label' => 'What could be improved?',
                        'type' => 'textarea',
                        'is_required' => false,
                        'description' => 'Tell us what could be improved'
                    ],
                    [
                        'name' => 'recommend',
                        'label' => 'Would you recommend this product?',
                        'type' => 'single-checkbox',
                        'is_required' => true
                    ]
                ]
            ],
            [
                'name' => 'Job Application',
                'description' => 'Professional job application form with resume upload.',
                'category' => 'registration',
                'icon' => 'registration',
                'fields_data' => [
                    [
                        'name' => 'first_name',
                        'label' => 'First Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'last_name',
                        'label' => 'Last Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true
                    ],
                    [
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'position',
                        'label' => 'Position Applied For',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'experience_years',
                        'label' => 'Years of Experience',
                        'type' => 'select',
                        'is_required' => true,
                        'options' => ['0-1 years', '2-3 years', '4-5 years', '6-10 years', '10+ years']
                    ],
                    [
                        'name' => 'education',
                        'label' => 'Education Level',
                        'type' => 'select',
                        'is_required' => true,
                        'options' => ['High School', 'Associate Degree', 'Bachelor\'s Degree', 'Master\'s Degree', 'PhD', 'Other']
                    ],
                    [
                        'name' => 'resume',
                        'label' => 'Resume/CV',
                        'type' => 'file',
                        'is_required' => true,
                        'description' => 'Upload your resume in PDF or DOC format'
                    ],
                    [
                        'name' => 'cover_letter',
                        'label' => 'Cover Letter',
                        'type' => 'textarea',
                        'is_required' => false,
                        'description' => 'Optional cover letter'
                    ]
                ]
            ],
            [
                'name' => 'Order Form',
                'description' => 'Simple order form for products and services.',
                'category' => 'order',
                'icon' => 'order',
                'fields_data' => [
                    [
                        'name' => 'customer_name',
                        'label' => 'Customer Name',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'email',
                        'label' => 'Email Address',
                        'type' => 'email',
                        'is_required' => true
                    ],
                    [
                        'name' => 'phone',
                        'label' => 'Phone Number',
                        'type' => 'text',
                        'is_required' => true
                    ],
                    [
                        'name' => 'product_selection',
                        'label' => 'Product Selection',
                        'type' => 'multiselect',
                        'is_required' => true,
                        'options' => ['Product A', 'Product B', 'Product C', 'Service X', 'Service Y']
                    ],
                    [
                        'name' => 'quantity',
                        'label' => 'Quantity',
                        'type' => 'number',
                        'is_required' => true
                    ],
                    [
                        'name' => 'delivery_address',
                        'label' => 'Delivery Address',
                        'type' => 'textarea',
                        'is_required' => true,
                        'description' => 'Please provide complete delivery address'
                    ],
                    [
                        'name' => 'special_instructions',
                        'label' => 'Special Instructions',
                        'type' => 'textarea',
                        'is_required' => false,
                        'description' => 'Any special delivery instructions or notes'
                    ]
                ]
            ]
        ];

        foreach ($templates as $templateData) {
            FormTemplate::create($templateData);
        }
    }
}