<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Company') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('company_store') }}">
            @csrf

            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full form-control" type="string" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="street" :value="__('Street')" />

                <x-input id="street" class="form-control block mt-1 w-full"
                                type="string"
                                name="street" :value="old('street')"
                                required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="code" :value="__('Postal code')" />

                <x-input id="code" class="block mt-1 w-full form-control"
                                type="string"
                                name="code" :value="old('code')"
                                required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="block mt-1 w-full form-control"
                                type="string"
                                name="city" :value="old('city')"
                                required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="form-control block mt-1 w-full"
                                type="integer"
                                name="phone" :value="old('phone')"
                                required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-control block mt-1 w-full"
                                type="email"
                                name="email" :value="old('email')"
                                required autofocus />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
