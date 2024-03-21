<x-app-layout>
    <x-header>
        {{ __('Vote for a question') }}
    </x-header>

    <x-container>
        {{--   listing     --}}
        <div class="dark:text-gray-300 text-lg uppercase font-bold border-l-4 border-yellow-500 pl-2">List of question
        </div>

        <div class="dark:text-gray-300 space-y-2">
            @foreach($question as $item)
                <x-questions :questions="$item"></x-questions>
            @endforeach
        </div>

    </x-container>
</x-app-layout>
