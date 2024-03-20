<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\get;

it('should list all the question', function () {
    //Arrange
    // creating some questions
    $user = User::factory()->create();

    $this->actingAs($user);

    $question = Question::factory()->count(5)->create();

    //Act, Access route
    $response = get(route('dashboard'));

    //Assert, Check if the list is being shown
    /** @var Question $vl */
    foreach ($question as $vl) {
        $response->assertSee($vl->question);
    }

});
