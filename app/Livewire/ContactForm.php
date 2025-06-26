<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Client\Factory as Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactForm extends Component
{
    public $firstname = '';
    public $email_address = '';
    public $website = '';
    public $contact_number = '';
    public $msg_subject = '';
    public $msg_body = '';
    public $hcaptcha_response = '';

    public $showSuccessMessage = false;
    public $isSubmitting = false;

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'email_address' => 'required|email|max:255',
        'website' => 'nullable|url|max:255',
        'contact_number' => 'required|string|max:20',
        'msg_subject' => 'required|string|max:255',
        'msg_body' => 'required|string|min:24|max:300',
        'hcaptcha_response' => 'required',
    ];

    protected $messages = [
        'firstname.required' => 'Name is required.',
        'email_address.required' => 'Email address is required.',
        'email_address.email' => 'Please enter a valid email address.',
        'contact_number.required' => 'Contact number is required.',
        'msg_subject.required' => 'Subject is required.',
        'msg_body.required' => 'Message is required.',
        'msg_body.min' => 'Message must be at least 24 characters long.',
        'msg_body.max' => 'Message cannot exceed 300 characters.',
        'hcaptcha_response.required' => 'Please complete the captcha verification.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->isSubmitting = true;

        $this->validate();

        // Verify hCaptcha
        if (!$this->verifyHCaptcha()) {
            $this->addError('hcaptcha_response', 'Captcha verification failed. Please try again.');
            $this->isSubmitting = false;
            return;
        }

        try {
            // Send email (you can customize this based on your needs)
            Mail::to(config('mail.contact_email', 'admin@example.com'))
                ->send(new ContactFormMail([
                    'firstname' => $this->firstname,
                    'email_address' => $this->email_address,
                    'website' => $this->website,
                    'contact_number' => $this->contact_number,
                    'msg_subject' => $this->msg_subject,
                    'msg_body' => $this->msg_body,
                ]));

            // Reset form and show success message
            $this->reset([
                'firstname',
                'email_address',
                'website',
                'contact_number',
                'msg_subject',
                'msg_body',
                'hcaptcha_response'
            ]);

            $this->showSuccessMessage = true;
            $this->dispatch('resetHCaptcha');

        } catch (\Exception $e) {
            $this->addError('form', 'An error occurred while sending your message. Please try again.');
        }

        $this->isSubmitting = false;
    }

    private function verifyHCaptcha()
    {
        $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
            'secret' => config('services.hcaptcha.secret_key'),
            'response' => $this->hcaptcha_response,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();

        return $result['success'] ?? false;
    }

    public function updateHCaptcha($token)
    {
        $this->hcaptcha_response = $token;
        $this->resetErrorBag('hcaptcha_response');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
