<?php

use App\Models\User;
use App\Models\Question;

use function Pest\Laravel\{actingAs, put};


it('should be able to publish a question', closure: function (){

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    if (!empty(expect($question)->draft)) {
        expect($question)->draft->toBeFalse();
    }
});

it('it should make sure that only person who has created the question can publish the question', function () {

    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    $this->actingAs($wrongUser);

    put(route('question.publish', $question))
        ->assertForbidden();

    $this->actingAs($rightUser);

    put(route('question.publish', $question))
        ->assertRedirect();
});
