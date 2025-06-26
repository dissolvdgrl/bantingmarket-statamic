<div class="bg-white shadow-xl p-4 rounded-md w-3/4">
    @if ($showSuccessMessage)
        <div class="bg-green-100 p-4 flex gap-4 text-xl rounded-md text-green-800 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Thank you! Your message has been sent successfully.
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 p-4 flex gap-4 text-xl rounded-md text-red-800 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
            Oops, you have some errors in your form. Please fix and try again.
        </div>
    @endif

    <form wire:submit="submit">
        <div id="cf_fn" class="form-group flex flex-col mt-4">
            <label for="firstname" class="font-sansBold">Name <span class="required text-red-500">*</span></label>
            <input type="text"
                   id="firstname"
                   wire:model.live="firstname"
                   class="border-b border-black mb-1 @error('firstname') border-red-500 @enderror"
                   placeholder="Jane Smith"
                   autocomplete="off">
            @error('firstname')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="cf_email" class="form-group flex flex-col mt-4">
            <label for="email_address" class="font-sansBold">Email address <span class="required text-red-500">*</span></label>
            <input type="email"
                   id="email_address"
                   wire:model.live="email_address"
                   class="border-b border-black mb-1 @error('email_address') border-red-500 @enderror"
                   placeholder="jane@example.com">
            @error('email_address')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="cf_web" class="form-group flex flex-col mt-4">
            <label for="website" class="font-sansBold">Website</label>
            <input type="url"
                   id="website"
                   wire:model.live="website"
                   class="border-b border-black mb-1 @error('website') border-red-500 @enderror"
                   placeholder="https://example.com"
                   autocomplete="off"
                   tabindex="-1">
            @error('website')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="cf_cn" class="form-group flex flex-col mt-4">
            <label for="contact_number" class="font-sansBold">Contact number <span class="required text-red-500">*</span></label>
            <input type="tel"
                   id="contact_number"
                   wire:model.live="contact_number"
                   class="border-b border-black mb-1 @error('contact_number') border-red-500 @enderror"
                   placeholder="012 345 6789"
                   autocomplete="off">
            @error('contact_number')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="cf_subj" class="form-group flex flex-col mt-4">
            <label for="msg_subject" class="font-sansBold">Subject <span class="required text-red-500">*</span></label>
            <input type="text"
                   id="msg_subject"
                   wire:model.live="msg_subject"
                   class="border-b border-black mb-1 @error('msg_subject') border-red-500 @enderror"
                   placeholder="Question about parking"
                   autocomplete="off">
            @error('msg_subject')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div id="cf_msg" class="form-group flex flex-col mt-4">
            <label for="msg_body" class="font-sansBold">Message <span class="required text-red-500">*</span></label>
            <textarea id="msg_body"
                      wire:model.live="msg_body"
                      class="border-b border-black mb-1 @error('msg_body') border-red-500 @enderror"
                      placeholder="Please type your message here..."
                      rows="4"></textarea>
            @error('msg_body')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- hCaptcha Integration -->
        <div class="form-group flex flex-col mt-4">
            <div class="h-captcha"
                 data-sitekey="{{ config('services.hcaptcha.site_key') }}"
                 data-callback="onHCaptchaSuccess"
                 data-expired-callback="onHCaptchaExpired"
                 data-error-callback="onHCaptchaError"></div>
            @error('hcaptcha_response')
            <span class="inline-error text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group flex flex-col mt-8 items-start">
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="bg-gray-800 p-4 relative mt-6 shadow-xl rounded-md transition-shadow duration-300 hover:shadow-none text-white disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="submit">Submit</span>
                <span wire:loading wire:target="submit">Sending...</span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <script>
        // hCaptcha callback functions
        function onHCaptchaSuccess(token) {
            @this.call('updateHCaptcha', token);
        }

        function onHCaptchaExpired() {
            @this.call('updateHCaptcha', '');
        }

        function onHCaptchaError() {
            @this.call('updateHCaptcha', '');
        }

        // Listen for Livewire events
        document.addEventListener('livewire:initialized', () => {
            @this.on('resetHCaptcha', () => {
                if (typeof hcaptcha !== 'undefined') {
                    hcaptcha.reset();
                }
            });
        });
    </script>
@endpush
