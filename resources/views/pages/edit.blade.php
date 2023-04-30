@extends( 'layouts.base' )

@section( 'content' )
    @include( 'includes.header' )
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border mt-4 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Update contact
                    </h1>
                    @if( $errors->has( 'general_error' ) )
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                            <span class="block sm:inline">{{ $errors->first( 'general_error' ) }}</span>
                        </div>
                    @endif
                    <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data" action="{{ route( 'update-contact', [ 'id' => $contact->id ] ) }}">
                        @csrf
                        <x-input value="{{ $contact->name }}" name="name" placeholder="John Doe" label="Name and Surname" type="text"></x-input>
                        <x-input value="{{ $contact->email }}" name="email" placeholder="john@doe.com" label="Email" type="email"></x-input>
                        <x-input value="{{ $contact->number }}" name="phone" placeholder="532323" label="Phone number" type="tel"></x-input>
                        <x-select selectedOption="{{ $contact->category_id }}" name="category" placeholder="Choose a category" label="Contact category" :options="$categories" value="id" text="name"></x-select>

                        <div>
                            <label for="dropzone-file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile picture</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                    </div>
                                    <input id="dropzone-file" name="file" type="file" class="hidden" />
                                </label>
                            </div>
                            @if( $errors->has( 'file' ) )
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
                                    <span class="block sm:inline">{{ $errors->first( 'file' ) }}</span>
                                </div>
                            @endif
                        </div>

                        <x-input value="{{ $contact->lat }}" name="lat" placeholder="34.43434" label="Location latitude" type="text"></x-input>
                        <x-input value="{{ $contact->long }}" name="long" placeholder="34.43434" label="Location longitude" type="text"></x-input>

                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save contact</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
    </section>
@endsection
