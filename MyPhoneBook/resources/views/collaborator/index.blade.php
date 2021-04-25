<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Collaborators') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('collaborator_search') }}" method="GET">
                        <div class="search-bar">
                            <div>
                                <x-label for="search_lname" :value="__('Lastname')" />
                                <x-input id="search_lname" class="block mt-1 w-full form-control" type="string" name="search_lname" autofocus />
                            </div>
                            <div>
                                <x-label for="search_fname" :value="__('Firstname')" />
                                <x-input id="search_fname" class="block mt-1 w-full form-control" type="string" name="search_fname" autofocus />
                            </div>
                            <div>
                                <x-label for="search_cname" :value="__('Company name')" />
                                <x-input id="search_cname" class="block mt-1 w-full form-control" type="string" name="search_cname" autofocus />
                            </div>

                            <div>
                                <x-label for="search_phone" :value="__('Phone')" />
                                <x-input id="search_phone" class="block mt-1 w-full form-control" type="string" name="search_phone" autofocus />
                            </div>

                            <div>
                                <x-label for="search_mail" :value="__('Email')" />
                                <x-input id="search_mail" class="block mt-1 w-full form-control" type="string" name="search_mail" autofocus />
                            </div>
                        </div>
                        <input type=submit class="btn btn-outline-success" value="Search">
                    </form><br>

                    <table class="table table-bordered">
                        <tr>
                            <th width="110px">Lastname</th>
                            <th width="110px">Firstname</th>
                            <th width="110px">Phone</th>
                            <th width="110px">Email</th>
                            <th width="110px"> Postal code</th>
                            <th width="110px">Company</th>
                            <th width="110px">Company id</th>
                            @if (Auth::user()->role != 3)
                                <th width="280px">Action</th>   
                            @endif
                        </tr>
                        <tbody id="myTable">
                            @foreach ($collaborators as $collaborator)
                                <?php
                                $company_name = App\Models\Company::select('name')->where('id', '=', $collaborator->company_id)->first()->name;
                                ?>
                                <tr>

                                    <td>{{ $collaborator->lastname }}</td>
                                    <td>{{ $collaborator->firstname }}</td>
                                    <td>{{ $collaborator->col_phone }}</td>
                                    <td>{{ $collaborator->col_email }}</td>
                                    <td>{{ $collaborator->col_code }}</td>
                                    <td>{{ $company_name }}</td>
                                    <td>{{ $collaborator->company_id }}</td>
                                    @if (Auth::user()->role != 3)
                                        <td>
                                            <form action="{{ route('collaborator_destroy',$collaborator->id) }}" method="POST">

                                                <a class="btn btn-outline-success" href="{{ route('collaborator_edit',$collaborator->id) }}">Update</a>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $collaborators->links() }}
                    @if (Auth::user()->role != 3)
                        <a class="btn btn-outline-success" href="{{ route('collaborator_create') }}"> Create new collaborator</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>