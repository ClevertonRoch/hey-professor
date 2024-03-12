<?php

use \App\Models\User;
use \App\Models\Question;

use function Pest\Laravel\post;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('Should be able to vote up a question, like a question', function (){
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question))->assertRedirect();

    assertDatabaseHas('votes',[
        'question_id' =>$question->id,
        'like' => 1,
        'unlike' => 0,
        'user_id' => $user->id
    ]);
});
