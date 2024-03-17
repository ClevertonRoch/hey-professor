<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMark;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMark(),
            ],
        ]);

        Question::query()
            ->create(
                [
                    'question' => request()->question,
                    'draft' => true
                ]
//                array_merge($attributes, ['draft' => true])
            );

        return to_route('dashboard');

    }
}
