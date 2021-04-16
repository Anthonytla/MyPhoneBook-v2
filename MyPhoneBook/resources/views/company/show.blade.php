<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company '.$company->id) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered">
                        <tr>
                            <th width="140px">Id</th>
                            <th width="140px">Name</th>
                            <th width="140px">Street</th>
                            <th width="140px">Postal Code</th>
                            <th width="140px">City</th>
                            <th width="140px">Phone</th>
                            <th width="140px">Email</th>
                        </tr>
                        <tr>

                            <td>{{ $company->id }}</td>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->street }}</td>
                            <td>{{ $company->code }}</td>
                            <td>{{ $company->city }}</td>
                            <td>{{ $company->phone }}</td>
                            <td>{{ $company->email }}</td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>