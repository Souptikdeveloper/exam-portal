<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model 
{

        protected $table = 'exam_result';
        public $timestamps = true;
        protected $fillable = array('user_id', 'qualifying_exam_score', 'qualifying_exam_status', 'grading_exam_score','grading_exam_status');
        protected $visible = array('user_id', 'qualifying_exam_score', 'qualifying_exam_status', 'grading_exam_score','grading_exam_status');

}
