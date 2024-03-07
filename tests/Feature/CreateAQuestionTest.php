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
    $request = post(route(name: 'question.store'),[
        'question'=> str_repeat(string: '*', times: 260) . '?'
    ]);

    //Assert

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', count: 1);
    assertDatabaseHas('questions', ['question' => str_repeat(string: '*', times: 260) . '?']);

});






//it('should check if ends with question mark', function(){
//
//
//
//});
//
//it('should have at least 10 characters', function(){
//
//
//
//});
