<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request) {
        $question = new Question();
        $question->question = $request->name;
        $question->answer = $request->answer;
        $question->gropu_id = $request->group_id;
        $question->save();

        return response()->json([
            'message' => 'Question created successfully',
            'question' => $question
        ]);
    }

    public function storeOrUpdate(Request $request) {
        $question = Question::where('user_id', $request->user_id)->where('question', $request->question)->first();

        if ($question) {
            $question->answer = $request->answer;
            $question->save();
        } else {
            $question = new Question();
            $question->question = $request->question;
            $question->answer = $request->answer;
            $question->user_id = $request->user_id;
            $question->save();
        }

        return new QuestionResource($question);
    }

    public function storeOrUpdateBukInsert(Request $request) {
        $questions = $request->questions;

        foreach ($questions as $question) {
            if ($question['question'] == null) {
                continue;
            }
            $questionModel = Question::where('user_id', $question['user_id'])->where('question', $question['question'])->first();

            if ($questionModel) {
                if ($questionModel->answer == $question['answer']) {
                    continue;
                }
                $questionModel->answer = $question['answer'];
                $questionModel->save();
            } else {
                if ($question['answer'] == null) {
                    continue;
                }
                $questionModel = new Question();
                $questionModel->question = $question['question'];
                $questionModel->answer = $question['answer'];
                $questionModel->user_id = $question['user_id'];
                $questionModel->save();
            }
        }
    }
}
