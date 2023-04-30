@extends( 'layouts.base' )

@section( 'content' )
    @include( 'includes.header' )
    <div class="max-w-screen-xl mx-auto mt-3">
        @if( $contacts->count() > 0 )
            <form class="mb-4">
                <div class="flex">
                    <select id="categories" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block rounded-br-none rounded-tr-none p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>All categories</option>
                        @foreach( $categories as $category )
                            <option @if( request()->get( 'category' ) && ! empty( request()->get( 'category' ) ) && request()->get( 'category' ) == $category->id ) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="relative w-full">
                        <input value="{{ request()->get( 'keyword' ) }}" type="search" name="keyword" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search by number, email or name">
                        <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>


            <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-1">
                @foreach( $contacts as $contact )
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="flex items-center px-6 py-4 border-b border-gray-200">
                                <div class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full" onerror="this.src = 'https://via.placeholder.com/150'" src="{{ asset( 'storage/' . $contact->file ) }}" alt="">
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $contact->name }}</h2>
                                    <p class="text-sm font-medium text-gray-500">{{ $contact->number }}</p>
                                </div>
                            </div>
                            <div class="px-6 pt-4">
                                <span class="text-sm font-medium text-gray-500">Email: {{ $contact->email }}</span>
                            </div>

                            <div class="px-6 py-4 border-b border-gray-200">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2" style="background-color: {{ $contact->category->color }}">#{{ lcfirst($contact->category->name) }}</span>
                            </div>
                            <div class="px-6 py-4">
                                <button data-modal-target="#confirmDeleteModal" data-id="{{ $contact->id }}" class="delete-button inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-500 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Delete</button>

                                <a href="{{ route( 'edit-contact', [ 'id' => $contact->id ] ) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                                <a href="{{ route( 'show-on-map', [ 'id' => $contact->id ] ) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">On map</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex align-middle justify-between">
                    <div class="w-full">
                        <p class="font-bold">Info</p>
                        <p class="text-sm">You don't have anyone in your contact list.</p>
                    </div>
                    <a href="{{ route( 'create-contact') }}" class="inline-flex whitespace-nowrap mr-auto items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create now</a>
                </div>
            </div>
        @endif
    </div>

@endsection


@section( 'extra-js' )
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const deleteButtons = document.querySelectorAll( '.delete-button' );
        deleteButtons.forEach( el => {
            el.addEventListener( 'click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Please confirm if you want to delete this item",
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then( async (result) => {
                    if ( result.isConfirmed ) {
                        const id = el.getAttribute( 'data-id' );
                        let response = await fetch( '/delete/' + id, {
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            method: 'delete',
                            body: JSON.stringify( {
                                '_token': '{{ csrf_token() }}'
                            } )
                        } );
                        response = await response.json();
                        if ( response.data )
                        {
                            window.location.reload();
                        }
                        else if ( response.error )
                        {
                            alert( response.error );
                        }
                    }
                })
            } );
        } );
    </script>
@endsection
