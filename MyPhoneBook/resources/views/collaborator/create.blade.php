<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New collaborator') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('collaborator_store') }}">
            @csrf

            <div>
                <x-label for="civility" :value="__('Civility')" />
                <div class="search-bar">
                    <div>
                        <input type="radio" name="civility" value=1 required />M
                    </div>
                    <div>
                        <input type="radio" name="civility" value=2 required />Mme

                    </div>

                    <div>
                        <input type="radio" name="civility" value=3 required />Other

                    </div>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="lastname" :value="__('Lastname')" />

                <x-input id="lastname" class="form-control block mt-1 w-full" type="string" name="lastname" :value="old('lastname')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="firstname" :value="__('Firstname')" />

                <x-input id="firstname" class="block mt-1 w-full form-control" type="string" name="firstname" :value="old('firstname')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="street" :value="__('Street')" />

                <x-input id="street" class="block mt-1 w-full form-control" type="string" name="street" :value="old('street')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="code" :value="__('Postal code')" />

                <x-input id="code" class="form-control block mt-1 w-full" type="integer" name="code" :value="old('code')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="form-control block mt-1 w-full" type="string" name="city" :value="old('city')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="form-control block mt-1 w-full" type="string" name="phone" :value="old('phone')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-control block mt-1 w-full" type="string" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="company" :value="__('Company')" />
                
                <select class="form-control block mt-1 w-full" name="company_name" id="companies">
                    @foreach ($companies as $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>