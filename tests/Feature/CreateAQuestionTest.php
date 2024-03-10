<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('should be able to create a new question bigger than 255 charcters', function(){

    // Arrage
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 254).'?',
    ]);

    //Assert

    $request->assertRedirect(route('dashboard'));

    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 254).'?']);

});

it('should check if ends with question mark', function(){

    // Arrage
    $user = User::factory()->create();
    actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    //Assert
    $request->assertSessionHasErrors(['question']);
    assertDatabaseCount('questions', 0);


});

it('should have at least 10 characters', function(){

    // Arrage
    $user = User::factory()->create();
    $this->actingAs($user);

    // Act
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8).'?',
    ]);

    //Assert

    $request->assertSessionHasErrors(['question']);
    assertDatabaseCount('questions', 0);


});
