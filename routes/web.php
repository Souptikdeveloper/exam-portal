<?php

Route::get('/', ['as' => 'user_register', 'uses' => 'Register\UserController@index']);
Route::post('store/user', ['as' => 'store_exam_register', 'uses' => 'Register\UserController@store']);


Route::group(['as'=>'exam::','prefix'=>'cpanel/exam'], function () {

    /*Exam Dashboard*/
    Route::get('exam_dashboard', ['as' => 'exam_dashboard', 'uses' => 'Exam\ExamDashboardController@exam_dashboard']);
    Route::get('start_exam', ['as' => 'start_exam', 'uses' => 'Exam\ExamDashboardController@start_exam']);
    Route::get('append_question/{id}/{i}', ['as' => 'append_question', 'uses' => 'Exam\ExamDashboardController@append_question']);

    /*Exam Score*/
    Route::get('exam_score', ['as' => 'exam_score', 'uses' => 'Exam\ExamScoreController@score']);

    /*Exam Resultboard*/

    Route::get('exam_board', ['as' => 'exam_board', 'uses' => 'Exam\ExamScoreController@qualify_exam_score']);

    /*Logout*/
    Route::get('exam_logout', ['as' => 'exam_logout', 'uses' => 'Exam\ExamDashboardController@exam_logout']);


    Route::post('append_question', ['as' => 'append_question', 'uses' => 'Exam\ExamDashboardController@append_question']);
    Route::post('check_exam_review', ['as' => 'check_exam_review', 'uses' => 'Exam\ExamDashboardController@check_exam_review']);
});

?>
