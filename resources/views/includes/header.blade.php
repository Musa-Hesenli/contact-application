@php
    $activeClass = 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500';
    $normalClass = 'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent';
@endphp
<nav class="bg-white border-gray-200 mb-2 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route( 'home-page' ) }}" class="@if( \Illuminate\Support\Facades\Route::current()->getName() === 'home-page' ) {{ $activeClass }} @else {{ $normalClass }} @endif" aria-current="page">Contacts</a>
                </li>
                <li>
                    <a href="{{ route( 'create-contact' ) }}" class="@if( \Illuminate\Support\Facades\Route::current()->getName() === 'create-contact' ) {{ $activeClass }} @else {{ $normalClass }} @endif">Add Contact</a>
                </li>
            </ul>
        </div>
        <div>
            <a href="{{ route( 'export' ) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Export to csv</a>
            <a href="{{ route( 'logout' ) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</a>
        </div>
    </div>
</nav>
