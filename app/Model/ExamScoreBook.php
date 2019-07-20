<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamScoreBook extends Model
{
    protected $table='examscorebook';
    protected $fillable=array('qualifying_exam_question_count','qualifying_exam_question_per_number','qualifying_exam_score_cutoff','grading_exam_question_count','grading_exam_question_per_number','grading_exam_question_cutoff');
    protected $visible=array('qualifying_exam_question_count','qualifying_exam_question_per_number','qualifying_exam_score_cutoff','grading_exam_question_count','grading_exam_question_per_number','grading_exam_question_cutoff');
}
