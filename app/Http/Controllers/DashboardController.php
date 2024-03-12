<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard',[
            'question' => Question::all()
        ]);
    }
}
