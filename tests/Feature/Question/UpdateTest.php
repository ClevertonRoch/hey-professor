<?php

use App\Models\Question;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('should br able to update a question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $question), [
        'question' => 'Updated Question?'
    ]) -> assertRedirect();

    $question->refresh();

    expect($question)->question->toBe('Updated Question?');

});

it('should make sure that only question with status Draft can be updated', function () {
    $user = User::factory()->create();

    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);

    $draftQuestion = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNotDraft))->assertForbidden();

    put(route('question.update', $draftQuestion), [
        'question' => 'New question?'
    ])->assertRedirect();

});

it('should make sure that only the person who has created the question can update question', function () {

    $rightUser = User::factory()->create();

    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(route('question.update', $question))->assertForbidden();

    actingAs($rightUser);

    put(route('question.update', $question), [
        'question' => 'New question?'
    ])->assertRedirect();

});
