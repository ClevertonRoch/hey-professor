<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;

it('should be able to destroy a question', closure: function () {

    $user = User::factory()->create();

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

    actingAs($user);

    delete(route('question.destroy', $question))
        ->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('it should make sure that only person who has created the question can destroy the question', function () {

    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    $this->actingAs($wrongUser);

    delete(route('question.destroy', $question))
        ->assertForbidden();

    $this->actingAs($rightUser);

    delete(route('question.destroy', $question))
        ->assertRedirect();
});
