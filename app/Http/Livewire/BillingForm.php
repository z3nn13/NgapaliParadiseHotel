<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class BillingForm extends Component
{
    public $firstName;
    public $lastName;
    public $email;
    public $phoneNo;

    public $paymentMethod = '2';
    public $country = "Myanmar";
    public $preferredCurrency = 'MMK';


    public function mount()
    {
        $authFields = ['firstName', 'lastName', 'email', 'phoneNo'];
        $fields = array_merge($authFields, ['paymentMethod', 'country', 'preferredCurrency']);

        $billingData = session('booking.billingData');
        if ($billingData) {
            foreach ($fields as $field) {
                $this->$field = $billingData[$field] ?? null;
            }
        } elseif (auth()->check()) {
            foreach ($authFields as $field) {
                $snakeCaseField = Str::snake($field);
                $this->$field = auth()->user()->$snakeCaseField;
            }
        }
    }

    public function render()
    {
        return view('livewire.billing-form');
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPreferredCurrency($value)
    {
        $this->emit('updatedPreferredCurrency', $value);
    }

    /**
     * Submits a form
     *
     * @return void
     */
    public function submitForm()
    {
        $this->validate();

        $formData = [];
        $attributes = ['firstName', 'lastName', 'email', 'phoneNo', 'paymentMethod', 'country', 'preferredCurrency'];

        foreach ($attributes as $attribute) {
            $formData[$attribute] = $this->$attribute;
        }
        $this->emit('formSubmitted', $formData);
    }


    protected $rules = [
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phoneNo' => 'required|string|max:20',
    ];
}
