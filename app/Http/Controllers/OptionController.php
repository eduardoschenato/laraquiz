<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Http\Controllers\Controller;
use App\Question;
use App\Option;

class OptionController extends Controller {

    public function index($question_id) {
        $options = Option::where('question_id', $question_id)->get();

        $question = Question::find($question_id);

        return view('options', [
            'options' => $options,
            'question' => $question
        ]);
    }

    public function create($question_id) {
        $option = new Option();
        $option->question_id = $question_id;

        return view('option', [
            'option' => $option
        ]);
    }

    public function store(Request $request, $question_id) {
        $rules = [
            'description' => 'required',
            'question_id' => 'required|exists:questions,id'
        ];

        $messages = [
            'description.required' => 'O campo descrição deve ser preenchido',
            'question_id.required' => 'A opção não está vinculada a uma questão',
            'question_id.exists' => 'Você deve vincular a opção a uma questão válida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $option = new Option();

        $option->question_id = $request->input('question_id');
        $option->description = $request->input('description');
        $option->correct = ($request->input('correct') == 'S');

        $option->save();

        return redirect()->route('options.index', ['question_id' => $option->question_id]);
    }

    public function edit($question_id, $id) {
        $option = Option::find($id);

        return view('option', [
            'option' => $option
        ]);
    }

    public function update(Request $request, $question_id, $id) {
        $rules = [
            'description' => 'required',
            'question_id' => 'required|exists:questions,id'
        ];

        $messages = [
            'description.required' => 'O campo descrição deve ser preenchido',
            'question_id.required' => 'A opção não está vinculada a uma questão',
            'question_id.exists' => 'Você deve vincular a opção a uma questão válida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $option = Option::find($id);

        $option->question_id = $request->input('question_id');
        $option->description = $request->input('description');
        $option->correct = ($request->input('correct') == 'S');

        $option->save();

        return redirect()->route('options.index', ['question_id' => $option->question_id]);
    }

    public function destroy($question_id, $id) {
        $option = Option::find($id);
        $option->delete();

        return redirect()->route('options.index', ['question_id' => $option->question_id]);
    }

}