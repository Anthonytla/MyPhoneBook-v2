<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('company_search') }}" method="GET">
                        <div class="search-bar">
                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="search_name" class="block mt-1 w-full form-control" type="string" name="search_name" autofocus />
                            </div>

                            <div>
                                <x-label for="city" :value="__('City')" />
                                <x-input id="search_city" class="block mt-1 w-full form-control" type="string" name="search_city" autofocus />
                            </div>

                            <div>
                                <x-label for="mail" :value="__('Email')" />
                                <x-input id="search_mail" class="block mt-1 w-full form-control" type="string" name="search_mail" autofocus />
                            </div>
                        </div>
                        <input type=submit class="btn btn-outline-success" value="Search">
                    </form><br>

                    <table class="table table-bordered">
                        <tr>
                            <th width="140px">Name</th>
                            <th width="140px">Phone</th>
                            <th width="140px">Email</th>
                            <th width="140px"> Postal code</th>
                            <th width="280px">Action</th>
                        </tr>
                        <tbody id="myTable">
                            @foreach ($companies as $company)
                            <tr>

                                <td>{{ $company->name }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->code }}</td>
                                <td>

                                    <form action="{{ route('company_destroy',$company->id) }}" method="POST">
                                        <a class="btn btn-outline-primary" href="{{ route('company_show',$company->id) }}">Show</a>
                                        @if (Auth::user()->role != 3)
                                        <a class="btn btn-outline-success" href="{{ route('company_edit',$company->id) }}">Update</a>


                                        <div id="myModal" class="modal">

                                            <div class="modal-content">
                                                <div class="close">&times;</div>
                                                <h5 class="text-center">Are you sure you want to delete {{ $company->name }} ?<br> Collaborators exist</h5>
                                            </div>
                                            <div class="modal-footer">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" id="cancel">Cancel</button>
                                                <button type="submit" class="btn btn-secondary" id="myBtn">Yes, Delete company</button>
                                            </div>
                                        </div>

                                        @if (count($company->collaborators()->get()) > 0)
                                        <button id="myBtn" class="btn btn-outline-danger">Delete</button>
                                        @else

                                        <button type="submit" class="btn btn-outline-danger">Delete</button>

                                        @endif
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $companies->links() }}
                    @if (Auth::user()->role != 3)
                    <a class="btn btn-outline-success" href="{{ route('company_create') }}"> Create new company</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        var modal = document.getElementById("myModal");

        var btn = document.getElementById("myBtn");

        var div = document.getElementsByClassName("close")[0];

        var cancel = document.getElementById("cancel");
        if (btn) {
            btn.onclick = function(event) {
                event.preventDefault();
                modal.style.display = "block";
            }
        }
        if (cancel) {
            cancel.onclick = function() {
                modal.style.display = "none";
            }
        }
        if (div) {
            div.onclick = function() {
                modal.style.display = "none";
            }
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</x-app-layout>