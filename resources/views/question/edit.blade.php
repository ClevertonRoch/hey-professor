<x-app-layout>
    <x-header>
        {{ __('Edit Question') }} :: {{ $question->id }}
    </x-header>

    <x-container>
        <x-form put :action="route('question.update', $question)">

            <x-textarea label="Question" name="question" :value="$question->question"></x-textarea>

            <x-btn.primary>Save</x-btn.primary>

            <x-btn.reset>Cancel</x-btn.reset>

        </x-form>

        <hr class="border-gray-600 border-dashed m-4">

    </x-container>
</x-app-layout>
