<x-app-layout>
    <x-header>
        {{ __('My Questions') }}
    </x-header>

    <x-container>
        <x-form post :action="route('question.store')">

            <x-textarea label="Question" name="question"/>

            <x-btn.primary>Save</x-btn.primary>

            <x-btn.reset>Cancel</x-btn.reset>

        </x-form>

        <hr class="border-gray-600 border-dashed m-4">

        {{--   listing     --}}

        <div class="dark:text-gray-300 text-lg uppercase font-bold border-l-4 border-yellow-500 pl-2">
            Drafts
        </div>

        <div class="dark:text-gray-300 space-y-2">
            <x-table.table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>

                @foreach($questions->where('draft', true) as $question)
                    <x-table.tr>
                        <x-table.th>{{ $question->question }}</x-table.th>
                        <x-table.td>
                            <div class="space-y-1 text-start">
{{--                                 Publish button--}}
                            <a href="{{ route('question.edit', $question) }}">
                                <button type="submit" class="hover:underline hover:text-green-400 text-green-500">
                                    Editar
                                </button>
                            </a>

                            <x-form :action="route('question.publish', $question)" put>
                                    <button type="submit" class="hover:underline hover:text-blue-400 text-blue-500">
                                        Publicar
                                    </button>
                            </x-form>
{{--                                Delete button--}}
                            <x-form :action="route('question.destroy', $question)" delete>
                                <button type="submit" class="hover:underline hover:text-red-400 text-red-500">
                                    Deletar
                                </button>
                            </x-form>
                            </div>

                        </x-table.td>
                    </x-table.tr>
                @endforeach

                </tbody>
            </x-table.table>

        </div>

        <br/> <hr/> <br/>
 {{--   listing     --}}
        <div class="dark:text-gray-300 text-lg uppercase font-bold border-l-4 border-yellow-500 pl-2">
            My Questions
        </div>

        <div class="dark:text-gray-300 space-y-2">
            <x-table.table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Action</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>

                @foreach($questions->where('draft', '=', false) as $question)
                    <x-table.tr>
                        <x-table.th>{{ $question->question }}</x-table.th>
                        <x-table.td>
                            <x-form :action="route('question.destroy', $question)" delete>
                                <button type="submit" class="hover:underline hover:text-red-400 text-red-500">
                                    Deletar
                                </button>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach

                </tbody>
            </x-table.table>

        </div>

    </x-container>
</x-app-layout>
