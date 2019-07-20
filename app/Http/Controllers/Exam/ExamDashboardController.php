<?php

namespace App\Http\Controllers\Exam;

use App\Model\Question;
use App\Model\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamDashboardController extends Controller
{
    public function exam_dashboard(){
        return view('Exam.exam_terms_condition');
    }
    public function exam_logout(){
        Auth::logout();
        return view('register');
    }
    public function start_exam(Request $request){
        $user_id = Auth::user()->id;
        $question_llist = Question::get();
        $questions = array();
        $answers =array();
        foreach ($question_llist as $row){
            array_push($questions,$row->id);
            $answers[$row->id] = '';
        }


        $count=Result::where('user_id',$user_id)->count();

        if($count == 0) {
            $question_list =  Result::create([
                'user_id' => $user_id,
                'questions' => json_encode($questions),
                'answers' => json_encode($answers)
            ]);
            return view('Exam.examnew',['question_list'=>$question_list]);
        }else{
            $question_list=Result::where('user_id',$user_id)->first();
            return view('Exam.examnew',['question_list'=>$question_list]);
        }

    }
    public function append_question(Request $request)
    {
        $answer = $request->answer;
        $prev = $request->prev;
        $next = $request->next;
        $mark = $request->mark;
        $user_id = Auth::user()->id;
        $student_user_id = $user_id;
        $question_list = Result::where('user_id', $student_user_id)->value('questions');
        $answer_list = Result::where('user_id', $student_user_id)->value('answers');
        $answers = json_decode($answer_list);
        $questions = json_decode($question_list);
        if ($answer != '' && $mark == '') {
            $class = 'not-visit';
        } else if ($mark != '') {
            $class = 'mark-area';
        } else {
            $class = 'not-ans-area';
        }
        if ($next < sizeof($questions)) {
            if ($prev != '') {
                $question_id = $questions[$prev];
            } else {
                $question_id = $questions[$next];
            }
            $question_data = Question::where('id', $questions[$next])->first();
            $ans_list = json_decode($question_data['answer']);
            $other_answer = $question_data['other_answer'];
            if ($other_answer == '') {
                foreach ($ans_list as $key => $value) {
                    $ans_list_arr[$key] = $value;
                }
                $answer_size = sizeof($ans_list_arr);
                if ($answer_size == 1) {
                    $answer = $request->answer;
                } else {
                    $answer = json_encode($request->answer);
                }
            } else {
                $answer = $request->answer;
            }
            $new_answer = array();
            if ($prev != '') {
                foreach ($answers as $key => $value) {
                    if ($key == $question_id) {
                        $new_answer[$key] = $answer;
                    } else {
                        $new_answer[$key] = $value;
                    }
                }
                $new_answer_list = json_encode($new_answer);
                Result::where('user_id', $student_user_id)->update(['answers' => $new_answer_list]);
            }

            $answer_list = Result::where('user_id', $student_user_id)->value('answers');
            $answers = json_decode($answer_list);
            $new_answer = array();
            foreach ($answers as $key => $value) {
                $new_answer[$key] = $value;
            }
            foreach ($ans_list as $key => $value) {
                $ans[$key] = $value;
            }
            $correct_answers = json_decode($question_data['correct_answer']);
//                return json_encode(array('status' => 'incomplete', 'html' => $question_data));
            $html = '';
            $html .= "<h1>Question " . ($next + 1) . " of " . sizeof($questions) . "</h1><p style=\"color:red\" id=\"complete_message\"></p>";
            $count_ans = count($correct_answers);

            $html .= "<div class=\"col-md-9 col-sm-8\">" .
                "<p>" . $question_data['question'] . "</p>";
            if (($count_ans == 1) && ($correct_answers[0] != 'other')) {
                foreach ($ans as $key => $value) {
                    $html .= "<div class=\"radio\">" .
                        "<input type=\"radio\" name=\"answer\" id=\"answer\" value=" . $key . ">" .
                        "<label for=" . $key . ">" . $value . "</label>" .
                        "</div>";
                }
            } elseif ($count_ans > 1) {
                foreach ($ans as $key => $value) {
                    $html .= "<div class=\"radio\">" .
                        "<input type=\"checkbox\" name=\"answer[]\" id=" . $key . " value=" . $key . ">" .
                        "<label for=" . $key . ">" . $value . "</label>" .
                        "</div>";
                }
            } else {
                $html .= '<div class="radio">' .
                    '<input type="text" name="other_answer" id="text_answer" value="">' .
                    '</div>';
            }
            $mark = 'mark';
            $buttons = ' <ul class="pull-left">
                             <li><button class="btn btn-primary" onclick="append_data(' . ($next) . ',' . ($next + 1) . ',' . $mark . ')">Mark for Review & next</button></li>
                             </ul>
                             <ul class="pull-left">
                             <li><button class="btn btn-success" onclick="append_data(' . ($next) . ',' . ($next - 1) . ','. ')">Previous</button></li>
                             </ul>
                             <ul class="pull-right">
                              <li><button class="btn btn-primary" onclick="append_data(' . ($next) . ',' . ($next + 1) . ')">Save and next</button></li>
                              </ul>';
            $submitbutton = '
                <button class="btn btn-primary pull-left"><i class="fa fa-send-o"></i> All Questions</button>
                    <button class="btn btn-success pull-right" data-toggle="modal" id="submit_button" data-target="#confirmModal"><i class="fa fa-send-o"></i> Submit</button>';


            $user_id = Auth::user()->id;
            $student_user_id = $user_id;
            $answer_list = Result::where('user_id', $student_user_id)->value('answers');
            $answers = json_decode($answer_list);
            $count = 0;
            foreach ($answers as $key => $value) {
                $count++;
            }

            return json_encode(array('status' => 'incomplete', 'html' => $html, 'buttons' => $buttons, 'class' => $class, 'next' => $next, 'prev' => $prev, 'submitbutton' => $submitbutton, 'questions' => $count));

        } else {
            $question_id = $questions[$prev];
            $question_data = Question::where('id', $questions[$prev])->first();
            $ans_list = json_decode($question_data['answer']);
            $other_answer = $question_data['other_answer'];
            if ($other_answer == '') {
                foreach ($ans_list as $key => $value) {
                    $ans_list_arr[$key] = $value;
                }
                $answer_size = sizeof($ans_list_arr);
                if ($answer_size == 1) {
                    $answer = $request->answer;
                } else {
                    $answer = json_encode($request->answer);
                }
            } else {
                $answer = $request->answer;
            }
            $new_answer = array();
            if ($prev != '') {
                foreach ($answers as $key => $value) {
                    if ($key == $question_id) {
                        $new_answer[$key] = $answer;
                    } else {
                        $new_answer[$key] = $value;
                    }
                }
                $new_answer_list = json_encode($new_answer);
                Result::where('user_id', $student_user_id)->update(['answers' => $new_answer_list]);
            }
            return json_encode(array('status' => 'complete', 'message' => 'You are already in last question click on submit or please check your previous questions.', 'class' => $class, 'next' => $next, 'prev' => $prev));
        }
    }
}
