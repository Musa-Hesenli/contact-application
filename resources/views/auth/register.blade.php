@extends( 'layouts.base' )

@section( 'content' )
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                        Create new account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route( 'register' ) }}">
                        @csrf

                        @if( $errors->has( 'general_error' ) )
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                <span class="block sm:inline">{{ $errors->first( 'general_error' ) }}</span>
                            </div>
                        @endif
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name and surname</label>
                            <input type="text" name="name" value="{{ old( 'name' ) }}" id="name" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="John Doe" required="">
                            @if( $errors->has( 'name' ) )
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first( 'name' ) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" value="{{ old( 'email' ) }}" id="email" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required="">
                            @if( $errors->has( 'email' ) )
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first( 'email' ) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @if( $errors->has( 'password' ) )
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first( 'password' ) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @if( $errors->has( 'password_confirmation' ) )
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first( 'password_confirmation' ) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="{{ route( 'login' ) }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
