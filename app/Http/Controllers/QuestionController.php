<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Controllers\Controller;
use App\Question;
use App\Category;

class QuestionController extends Controller {

    public function index() {
        $questions = Question::all();

        return view('questions', [
            'questions' => $questions
        ]);
    }

    public function create() {
        $question = new Question();

        $categories = Category::all();

        return view('question', [
            'question' => $question,
            'categories' => $categories
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'description' => 'required|min:3',
            'category_id' => 'required|exists:categories,id'
        ];

        $messages = [
            'description.required' => 'O campo descrição deve ser preenchido',
            'description.min' => 'O campo descrição deve ter pelo menos 3 caracteres',
            'category_id.required' => 'Uma categoria deve ser selecionada',
            'category_id.exists' => 'Você deve selecionar uma categoria válida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $question = new Question();

        $question->category_id = $request->input('category_id');
        $question->description = $request->input('description');

        if($request->hasFile('image')) {
            $filename = uniqid() . "." . $request->file('image')->extension();
            $path = $request->file('image')->storeAs('public/questions', $filename);
            $question->url_image = $filename;
        } else {
            $question->url_image = "";
        }

        $question->save();

        return redirect()->route('questions.index');
    }

    public function edit($id) {
        $question = Question::find($id);

        $categories = Category::all();

        return view('question', [
            'question' => $question,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'description' => 'required|min:3',
            'category_id' => 'required|exists:categories,id'
        ];

        $messages = [
            'description.required' => 'O campo descrição deve ser preenchido',
            'description.min' => 'O campo descrição deve ter pelo menos 3 caracteres',
            'category_id.required' => 'Uma categoria deve ser selecionada',
            'category_id.exists' => 'Você deve selecionar uma categoria válida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $question = Question::find($id);

        $question->category_id = $request->input('category_id');
        $question->description = $request->input('description');

        if($request->hasFile('image')) {
            $filename = uniqid() . "." . $request->file('image')->extension();
            $path = $request->file('image')->storeAs('public/questions', $filename);
            $question->url_image = $filename;
        }

        $question->save();

        return redirect()->route('questions.index');
    }

    public function destroy($id) {
        $question = Question::find($id);
        $question->delete();

        return redirect()->route('questions.index');
    }

}