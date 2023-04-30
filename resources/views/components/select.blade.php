<div>
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="bg-gray-50 w-full border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected>{{ $placeholder }}</option>
        @foreach( $options as $option )
            <option @if( ! empty( $selectedOption ) && $selectedOption == $option->{ $value }) selected @endif  value="{{ $option->{ $value } }}">{{ $option->{ $text } }}</option>
        @endforeach
    </select>
    @if( $errors->has( $name ) )
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-2 relative" role="alert">
            <span class="block sm:inline">{{ $errors->first( $name ) }}</span>
        </div>
    @endif
</div>
