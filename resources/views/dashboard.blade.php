<x-app-layout>
    <x-header>
        {{ __('Dashboard') }}
    </x-header>

    <x-container>
        <x-form post :action="route('question.store')">

            <x-textarea label="Question" name="question"/>

            <x-btn.primary>Save</x-btn.primary>

            <x-btn.reset>Cancel</x-btn.reset>

        </x-form>

        <hr class="border-gray-600 border-dashed m-4">

{{--   listing     --}}
    <div class="dark:text-gray-300 text-lg uppercase font-bold border-l-4 border-yellow-500 pl-2">List of question</div>

        <div class="dark:text-gray-300 space-y-2">
         @foreach($question as $item)
             <x-questions :questions="$item"></x-questions>
         @endforeach
     </div>

    </x-container>
</x-app-layout>
