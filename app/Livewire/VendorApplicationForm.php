<?php

namespace App\Livewire;

use Livewire\Component;

class VendorApplicationForm extends Component
{
    public $vendor_name = '';
    public $first_name = '';
    public $last_name = '';
    public $phone_number = '';
    public $email = '';
    public $website = '';
    public $facebook = '';
    public $instagram = '';
    public $produce_own_products = '';
    public $stand_option = '';
    public $uses_gas = false;
    public $terms_accepted = false;

    public $products = [
        ['name' => '', 'ingredients' => '']
    ];

    protected $rules = [
        'vendor_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'website' => 'nullable|url|max:255',
        'facebook' => 'nullable|url|max:255',
        'instagram' => 'nullable|url|max:255',
        'produce_own_products' => 'required|in:yes,no',
        'products.*.name' => 'required|string|max:255',
        'products.*.ingredients' => 'required|string|max:500',
        'stand_option' => 'required|in:standard,electricity',
        'uses_gas' => 'boolean',
        'terms_accepted' => 'accepted',
    ];

    protected $messages = [
        'vendor_name.required' => 'Stall/Business Name is required.',
        'first_name.required' => 'Name is required.',
        'last_name.required' => 'Surname is required.',
        'phone_number.required' => 'Phone Number is required.',
        'email.required' => 'Email Address is required.',
        'email.email' => 'Please enter a valid email address.',
        'produce_own_products.required' => 'Please specify if you produce your own products.',
        'products.*.name.required' => 'Product name is required.',
        'products.*.ingredients.required' => 'Product ingredients are required.',
        'stand_option.required' => 'Please choose a stand option.',
        'terms_accepted.accepted' => 'You must accept the terms and conditions.',
    ];

    public function addProduct()
    {
        $this->products[] = ['name' => '', 'ingredients' => ''];
    }

    public function removeProduct($index)
    {
        if (count($this->products) > 1) {
            unset($this->products[$index]);
            $this->products = array_values($this->products);
        }
    }

    public function submit()
    {
        $this->validate();

        // Process the form submission here
        // For example, save to database, send email, etc.

        // Example: Create a new stall application
        // StallApplication::create([
        //     'stall_name' => $this->stallName,
        //     'first_name' => $this->firstName,
        //     'last_name' => $this->lastName,
        //     'phone_number' => $this->phoneNumber,
        //     'email' => $this->email,
        //     'website' => $this->website,
        //     'facebook' => $this->facebook,
        //     'instagram' => $this->instagram,
        //     'product_production' => $this->productProduction,
        //     'products' => json_encode($this->products),
        //     'stand_option' => $this->standOption,
        //     'use_gas' => $this->useGas,
        //     'terms_accepted' => $this->termsAndConditions,
        // ]);

        session()->flash('message', 'Application submitted successfully!');
        $this->reset();
        $this->products = [['name' => '', 'ingredients' => '']];
    }

    public function render()
    {
        return view('livewire.vendor-application-form');
    }
}
