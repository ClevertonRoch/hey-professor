<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMark;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{


    public function index(): View
    {
        $questions = user()->questionBy()->get();

        return view('question.index', [
            'questions'         => $questions
        ]);

    }


    public function store(): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMark(),
            ],
        ]);
        //        Question::query()
        user()->questionBy()
            ->create(
                [
                    'question' => request()->question,
                    'draft' => true,
                ]
                //                array_merge($attributes, ['draft' => true])
            );

        return back();
//        return to_route('dashboard');

    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
