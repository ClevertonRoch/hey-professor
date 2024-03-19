<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;


class PublishController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {

        $this->authorize('publish',$question);
//        abort_unless(user()->can('publish', $question), Response::HTTP_FORBIDDEN);

        $question->update(['draft' => false]);

        return back();
    }
}
