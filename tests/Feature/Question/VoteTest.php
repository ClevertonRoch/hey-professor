<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to unlike more a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.unlike', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like' => 0,
        'unlike' => 1,
        'user_id' => $user->id,
    ]);
});

it('should not be able to unlike more than 1 time', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.unlike', $question));

    expect($user->votes()->where('question_id', '=', $question->id)->get())
        ->toHaveCount(1);
});
