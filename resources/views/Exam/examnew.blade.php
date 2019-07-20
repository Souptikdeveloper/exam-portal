@extends('Exam.layouts.examlayoutnew')
@section('exam-content')

    <section id="page-area1">
        <div class="container">

            <div class="col-md-8">
                <div class="exam-name-area">
                    <p>Exam Portal General Studies</p>
                </div>
                <?php
                $question = json_decode($question_list->questions);
                ?>
                <div id="content" class="inner-area">
                    <h1>Question 1 of {{sizeof($question)}}</h1><p style="color:red" id="complete_message"></p>
                    <?php $question_data = App\Model\Question::where('id',$question[0])->first();
                    $answers_list=json_decode($question_data['answer']);
                    foreach ($answers_list as $key => $value){
                        $answers[$key] = $value;
                    }
                    $correct_answers=json_decode($question_data['correct_answer']);
//                    dd($answers[$key]);
                    ?>
                    <p>{!! $question_data['question'] !!} </p>
                    <?php
                    $count_ans=count($correct_answers);
                    if(($count_ans==1)&&($correct_answers[0]!='other')){
                    foreach ($answers as $key => $value){?>
                    <div class="radio">
                        <input type="radio" name="answer" id="{{$key}}" value="{{$key}}">
                        <label for="{{$key}}">{!! $value !!}</label>
                    </div>
                    <?php }
                    }elseif ($count_ans>1){
                    foreach ($answers as $key => $value){
                        ?>
                    <div class="radio">
                        <input type="checkbox" name="answer[]" id="{{$key}}" value="{{$key}}">
                        <label for="{{$key}}">{!! $value !!}</label>
                    </div>
                    <?php }
                    }else{ ?>
                    <div class="radio">
                        <input type="text" name="other_answer" id="text_answer" value="">
                    </div>
                    <?php } ?>

                </div>

                <div class="inner-area1" id="button">
                    <ul class="pull-left">
                        <li><button class="btn btn-primary" onclick="append_data('0','1','mark')">Mark for Review and next</button></li>
                    </ul>


                    <ul class="pull-right">
                        <li><button class="btn btn-success" onclick="append_data('0','1','')">Save and next</button></li>
                    </ul>

                </div>
            </div>

            <div class="col-md-4">
                <div class="timer-area">
                    <span id="demo"></span>
                </div>
                <div class="number-page-area">
                    <h1>You Are Viewing <strong>Exam Portal</strong></h1>
                    <ul>
                        @for($j=0;$j <sizeof($question);$j++)
                        <li id="page_{{$j}}"><a style="cursor: pointer;" onclick="append_data('','{{$j}}')">{{$j+1}}</a></li>
                        @endfor
                    </ul>
                </div>

                <div class="indication-area">
                    <p> <span></span> Answered </p>
                    <p> <span class="not-ans-area"></span> Not Answered </p>
                    <p> <span class="mark-area"></span> Marked</p>
                    <p> <span class="not-atten-area"></span> Not Visit</p>
                </div>

                <div class="indication-area-button" id="submitbutton">
                    <button class="btn btn-success pull-right" id="submit_button" data-target="#confirmModal"><i class="fa fa-send-o"></i> Submit</button>
                </div>

            </div>

        </div>
    </section>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Your Exam Review and Confirmation</h4>
                </div>
                <div class="modal-body">
                    <section id="page-area1">
                        <div class="container">
                            <div class="col-md-4">
                                <div class="timer-area">
                                    <p>Total no. of question attempt - <span id="question_attempt"></span></p>
                                </div>
                                <div class="number-page-area">
                                    <h1>You Are Viewing <strong>Exam Portal</strong></h1>
                                    <ul>
                                        @for($j=0;$j <sizeof($question);$j++)
                                            <li id="page_2{{$j}}"><a onclick="append_data('','{{$j}}','')">{{$j+1}}</a></li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="indication-area">
                                    <p> <span></span> Answered </p>
                                    <p> <span class="not-ans-area"></span> Not Answered </p>
                                    <p> <span class="mark-area"></span> Marked</p>
                                    <p> <span class="not-atten-area"></span> Not Visit</p>
                                </div>

                            </div>

                        </div>
                    </section>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-default" onclick="yes()">Yes</button>
                </div>
            </div>

        </div>
    </div>
    @push('scripts')
    <script>
        function  append_data(prev,next,mark) {
            var answer = $("input[name='answer']:checked").val();
            var other_answer = $("input[name='other_answer']").val();
            if(answer){
                answer = answer;
            }else if(other_answer){
                answer = other_answer;
            }else{
                var val = [];
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();
                });
                answer =   val;
            }
            $.ajax({
                type: 'post',
                data: { '_token': '<?php echo csrf_token(); ?>',prev:prev,next:next,answer:answer,mark:mark},
                url: '{{route('exam::append_question')}}',
                success: function(data) {
                    console.log(data);
                    var resp = JSON.parse(data);
                    if(resp.status =='incomplete') {
                        $('#content').empty().html(resp.html);
                        $('#button').empty().html(resp.buttons);
                        $('#submitbutton').empty().html(resp.submitbutton);
                        $('#page_'+resp.prev).addClass(resp.class);
                        $('#page_2'+resp.prev).addClass(resp.class);
                        $('#question_attempt').text(resp.questions);
                    }else{
                        $('#complete_message').text(resp.message);
                        $('#page_'+resp.prev).addClass(resp.class);
                        $('#page_2'+resp.prev).addClass(resp.class);
                        $('#question_attempt').text(resp.questions);
                    }
                }
            });
        }

        $('#button').on('click', '#submit_button', function(){
            $.ajax({
                type: 'post',
                data: { '_token': '<?php echo csrf_token(); ?>'},
                url: '{{route('exam::check_exam_review')}}',
                success: function(data) {
                    console.log(data);
                    var resp = JSON.parse(data);
                    $('#question_attempt').text(resp.questions);
                    $('#data').empty().html(resp.html);
                }
            });
        });

        function yes(){
            window.location.href="<?php echo route('exam::exam_score')?>";
        }
    </script>
    <!------------------------------------------------- Countdown --------------------------------------------------------->
    <script>
        var d = new Date();
        var countDownDate = d.getTime() + (1000 * 60 * 60 *24);
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) /  (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML =  hours + "h " + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                window.location.href="<?php echo route('exam::exam_logout'); ?>";
            }
        }, 1000);
    </script>
    <script>
        /**/
          $(document).bind("contextmenu",function(e) {
          e.preventDefault();
          });
          document.onkeydown = function(e) {
          if(e.keyCode == 123) {
          return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
          return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
          return false;
          }
          if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
          return false;
          }

          if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
          return false;
          }
          }

    </script>
    @endpush
@endsection
