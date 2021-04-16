<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update collaborator') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('collaborator_update', $collaborator->id) }}">
            @csrf

            <div>
                <x-label for="civility" :value="__('Civility')" />
                <div class="search-bar">
                    <div>
                        <input type="radio" id="M" name="civility" value=1 required />M
                    </div>
                    <div>
                        <input type="radio" id="Mme" name="civility" value=2 required />Mme

                    </div>

                    <div>
                        <input type="radio" id="Other" name="civility" value=3 required />Other

                    </div>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="lastname" :value="__('Lastname')" />

                <x-input id="lastname" class="form-control block mt-1 w-full" type="string" name="lastname" :value="$collaborator->lastname" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="firstname" :value="__('Firstname')" />

                <x-input id="firstname" class="block mt-1 w-full form-control" type="string" name="firstname" :value="$collaborator->firstname" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="street" :value="__('Street')" />

                <x-input id="street" class="block mt-1 w-full form-control" type="string" name="street" :value="$collaborator->col_street" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="code" :value="__('Postal code')" />

                <x-input id="code" class="form-control block mt-1 w-full" type="integer" name="code" :value="$collaborator->col_code" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="form-control block mt-1 w-full" type="string" name="city" :value="$collaborator->col_city" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="form-control block mt-1 w-full" type="string" name="phone" :value="$collaborator->col_phone" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-control block mt-1 w-full" type="string" name="email" :value="$collaborator->col_email" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="company" :value="__('Company')" />

                <select class="form-control block mt-1 w-full" name="company_name" id="companies">

                    <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    <script>
        $(document).ready(function() {
            var value = <?php echo $collaborator->civility; ?>;
            if (value == 1)
                $('#M').attr("checked", "checked");
            else if (value == 2)
                $('#Mme').attr("checked", "checked");
            else if (value == 3)
                $('#Other').attr("checked", "checked");
        })
    </script>
</x-app-layout>