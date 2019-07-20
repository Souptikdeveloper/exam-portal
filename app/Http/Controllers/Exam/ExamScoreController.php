<?php

namespace App\Http\Controllers\Exam;

use App\Model\ExamResult;
use App\Model\ExamScoreBook;
use App\Model\Question;
use App\Model\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamScoreController extends Controller
{
    public function score(Request $request){
        $uid = Auth::user()->id;
        $id = $uid;
        $scored =  Result::where('user_id',$id)->value('answers');
        $score= json_decode($scored);
        foreach ($score as $key => $value){
            $new_score_arr[$key] = str_replace('"','',$value);
        }
        $i = 0;
        $questiuon_number = ExamScoreBook::get();
        $number = $questiuon_number[0]->qualifying_exam_question_per_number;
        $count=0;
        foreach($new_score_arr as $key=>$values) {
            $correctAns = Question::where('id', $key)->value('correct_answer');
            $correctAns_arr = json_decode($correctAns);
            if (in_array('other', $correctAns_arr)) {
                $other_answer = Question::where('id', $key)->value('other_answer');
                if($values == $other_answer){
                    $count = $count + 1;
                }
            }else {
                if(count($correctAns_arr) ==1) {
                    if (in_array($values, $correctAns_arr)) {
                        $count = $count + 1;
                    }
                }
                else{
                    $valfirst = str_replace("[",'',$values);
                    $vallast = str_replace("]",'',$valfirst);
                    $val_array = explode(',',$vallast);
                    if($val_array == $correctAns_arr){
                        $count = $count + 1;
                    }
                }
            }
        }
        $count = $count * $number;
        Result::where('user_id',$id)->update([
            'score'=>$count
        ]);
        if($count >= $questiuon_number[0]->qualifying_exam_score_cutoff) {

            $examCOUNT = ExamResult::where('user_id',$id)->count();

            if($examCOUNT){
                ExamResult::where('user_id',$id)->update([
                    'user_id' => $id,
                    'qualifying_exam_score' => $count,
                    'qualifying_exam_status' => 'Pass',
                    'grading_exam_score' => 0
                ]);
            }else{
                ExamResult::create([
                    'user_id' => $id,
                    'qualifying_exam_score' => $count,
                    'qualifying_exam_status' => 'Pass',
                    'grading_exam_score' => 0
                ]);
            }

        }else{

            $examCOUNT = ExamResult::where('user_id',$id)->count();

            if($examCOUNT){
                ExamResult::where('user_id',$id)->update([
                    'user_id' => $id,
                    'qualifying_exam_score' => $count,
                    'qualifying_exam_status' => 'Failed',
                    'grading_exam_score' => 0
                ]);
            }else{
                ExamResult::create([
                    'user_id' => $id,
                    'qualifying_exam_score' => $count,
                    'qualifying_exam_status' => 'Failed',
                    'grading_exam_score' => 0
                ]);
            }
        }

        return redirect(route('exam::exam_board'));

    }

    public function qualify_exam_score(){
        $info = ExamResult::select('users.*','exam_result.*')->join('users','exam_result.user_id','users.id')->where('users.id',Auth::user()->id)->get();
        return view('Exam.qualify_exam',['info'=>$info]);
    }
}
