<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <input type="{{ $type }}" value="{{ ! ( empty( $value ) ) ? $value : old( $name ) }}" name="{{ $name }}" id="{{ $name }}" class="bg-gray-50 border-2 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $placeholder }}" >
    @if( $errors->has( $name ) )
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
            <span class="block sm:inline">{{ $errors->first( $name ) }}</span>
        </div>
    @endif
</div>
