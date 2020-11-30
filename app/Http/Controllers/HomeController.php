<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Category;
use App\Question;

class HomeController extends Controller {
    
    public function index() {
        $categories = Category::all();

        return view('home', [
            'categories' => $categories
        ]);
    }

    public function quiz(Request $request) {
        $questions = Question::where('category_id', $request->input('category'))
                                ->orderByRaw('RAND()')
                                ->take($request->input('questions'))
                                ->get();

        return view('quiz', [
            'questions' => $questions
        ]);
    }

    public function result(Request $request) {
        $questions = [];
        $total = 0;
        $count = count($request->input('answers'));

        foreach($request->input('answers') as $question_id => $option_id) {
            $question = Question::find($question_id);
            $correctOption = $question->options()->where('correct', true)->first();

            if($correctOption->id == $option_id) {
                $total++;
                $question->correct = true;
            } else {
                $question->correct = false;
            }

            array_push($questions, $question);
        }

        return view('result', [
            'questions' => $questions,
            'total' => $total,
            'count' => $count
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
