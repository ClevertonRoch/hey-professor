<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

it('should br able to update a question', function () {
    $user = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $question), [
        'question' => 'Updated Question?',
    ])->assertRedirect(route('question.index'));

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
        'question' => 'New question?',
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
        'question' => 'New question?',
    ])->assertRedirect();

});

it('should be able to update a question bigger than 255 characters', function () {

    // Arrage
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    // Act
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 254).'?',
    ])->assertRedirect();

    //Assert

    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 254).'?']);

});

it('should check if ends with question mark', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors();

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});

it('should have at least 10 characters', function () {

    // Arrage
    $user = User::factory()->create();

    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    $this->actingAs($user);

    // Act
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8).'?',
    ]);

    //Assert

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});

