<div>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="stallName" class="block text-sm font-bold text-gray-700">
                Stall/Business Name <span class="text-red-700">*</span>
            </label>
            <input type="text"
                   id="stallName"
                   wire:model="vendor_name"
                   class="mt-1 p-2 w-full border rounded-md @error('vendor_name') border-red-500 @enderror">
            @error('vendor_name')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="firstName" class="block text-sm font-bold text-gray-700">
                    Name <span class="text-red-700">*</span>
                </label>
                <input type="text"
                       id="firstName"
                       wire:model="first_name"
                       class="mt-1 p-2 w-full border rounded-md @error('first_name') border-red-500 @enderror">
                @error('first_name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="lastName" class="block text-sm font-bold text-gray-700">
                    Surname <span class="text-red-700">*</span>
                </label>
                <input type="text"
                       id="lastName"
                       wire:model="last_name"
                       class="mt-1 p-2 w-full border rounded-md @error('last_name') border-red-500 @enderror">
                @error('last_name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="phoneNumber" class="block text-sm font-bold text-gray-700">
                Phone Number <span class="text-red-700">*</span>
            </label>
            <input type="tel"
                   id="phoneNumber"
                   wire:model="phone_number"
                   class="mt-1 p-2 w-full border rounded-md @error('phone_number') border-red-500 @enderror">
            @error('phone_number')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold text-gray-700">
                Email Address <span class="text-red-700">*</span>
            </label>
            <input type="email"
                   id="email"
                   wire:model="email"
                   class="mt-1 p-2 w-full border rounded-md @error('email') border-red-500 @enderror">
            @error('email')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="website" class="block text-sm font-bold text-gray-700">Website</label>
            <input type="url"
                   id="website"
                   wire:model="website"
                   class="mt-1 p-2 w-full border rounded-md @error('website') border-red-500 @enderror">
            @error('website')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="facebook" class="block text-sm font-bold text-gray-700">Facebook Page</label>
            <input type="url"
                   id="facebook"
                   wire:model="facebook"
                   class="mt-1 p-2 w-full border rounded-md @error('facebook') border-red-500 @enderror">
            @error('facebook')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="instagram" class="block text-sm font-bold text-gray-700">Instagram Page</label>
            <input type="url"
                   id="instagram"
                   wire:model="instagram"
                   class="mt-1 p-2 w-full border rounded-md @error('instagram') border-red-500 @enderror">
            @error('instagram')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <fieldset class="space-y-2">
                <legend class="block text-sm font-bold text-gray-700">
                    Do you, the applicant, produce your products? <span class="text-red-700">*</span>
                </legend>
                <div class="flex flex-col">
                    <label class="inline-flex items-center">
                        <input type="radio"
                               wire:model="produce_own_products"
                               value="yes"
                               class="form-radio text-indigo-600">
                        <span class="ml-2">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio"
                               wire:model="produce_own_products"
                               value="no"
                               class="form-radio text-indigo-600">
                        <span class="ml-2">No</span>
                    </label>
                </div>
                @error('produce_own_products')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>

        <div class="mb-8">
            <h4 class="font-bold mb-4">Products</h4>
            @foreach($products as $index => $product)
                <div class="border border-gray-200 p-4 rounded-md mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="productName{{ $index }}" class="block text-sm font-bold text-gray-700">
                                Product Name <span class="text-red-700">*</span>
                            </label>
                            <input type="text"
                                   id="productName{{ $index }}"
                                   wire:model="products.{{ $index }}.name"
                                   class="mt-1 p-2 w-full border rounded-md @error('products.'.$index.'.name') border-red-500 @enderror">
                            @error('products.'.$index.'.name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="productIngredients{{ $index }}" class="block text-sm font-bold text-gray-700">
                                Product Ingredients <span class="text-red-700">*</span>
                            </label>
                            <input type="text"
                                   id="productIngredients{{ $index }}"
                                   wire:model="products.{{ $index }}.ingredients"
                                   class="mt-1 p-2 w-full border rounded-md @error('products.'.$index.'.ingredients') border-red-500 @enderror">
                            @error('products.'.$index.'.ingredients')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if(count($products) > 1)
                        <button type="button"
                                wire:click="removeProduct({{ $index }})"
                                class="bg-red-600 text-white px-3 py-1 rounded-md text-xs hover:bg-red-700">
                            Remove Product
                        </button>
                    @endif
                </div>
            @endforeach

            <button type="button"
                    wire:click="addProduct"
                    class="bg-gray-800 p-2 text-white rounded-md text-xs cursor-pointer hover:bg-gray-900">
                Add another product &plus;
            </button>
        </div>

        <div class="mb-4">
            <fieldset class="space-y-2">
                <legend class="block text-sm font-bold text-gray-700">
                    Choose a Stand Option <span class="text-red-700">*</span>
                </legend>
                <label class="inline-flex items-center">
                    <input type="radio"
                           wire:model="stand_option"
                           value="standard"
                           class="form-radio text-indigo-600">
                    <span class="ml-2">3 × 2.5m stand</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio"
                           wire:model="stand_option"
                           value="electricity"
                           class="form-radio text-indigo-600">
                    <span class="ml-2">3 × 2.5m stand + electricity</span>
                </label>
                @error('stand_option')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </fieldset>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox"
                       wire:model="uses_gas"
                       class="form-checkbox text-indigo-600">
                <span class="ml-2">I use gas</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox"
                       wire:model="terms_accepted"
                       class="form-checkbox text-indigo-600">
                <span class="ml-2">I have read and understood the terms and conditions <span class="text-red-700">*</span></span>
            </label>
            @error('terms_accepted')
            <span class="text-red-500 text-xs block mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-dark-green text-white px-4 py-2 rounded-md hover:bg-gray-900 duration-300 transition-all"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>Submitting...</span>
            </button>
        </div>
    </form>
</div>
