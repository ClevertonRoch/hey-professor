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
    </x-container>
</x-app-layout>
