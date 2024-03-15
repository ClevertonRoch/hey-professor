@props([
    'questions'
])

<div class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 p-3 rounded shadow shadow-blue-500 flex
justify-between items-center">
    <span>{{ $questions->question }}</span>
    <div>

        <x-form :action="route('question.like', $questions)" id="form-like-{{ $questions->id }}">
            <button class="flex items-center space-x-2 text-green-400" type="submit"
                    form="form-like-{{ $questions->id }}">
                <x-icons.thumbs-down
                    class="w-5 h-5 text-green-300 hover:w-6 hover:h-6 hover:text-green-400 cursor-pointer"
                    id="thumb-down"/>
                <span>{{ $questions->likes }}</span>
            </button>
        </x-form>

        <x-form :action="route('question.like', $questions)" id="form-unlike-{{ $questions->id }}">
            <button class="flex items-center space-x-2 text-red-600" type="submit" form="form-unlike-{{ $questions->id }}">
                <x-icons.thumbs-up class="w-5 h-5 text-red-300 hover:w-6 hover:h-6 hover:text-red-400 cursor-pointer"
                                   id="thumb-up"/>
                <span>{{ $questions->unlikes }}</span>
            </button>
        </x-form>
    </div>

</div>
