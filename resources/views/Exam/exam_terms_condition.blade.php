@extends('Exam.layouts.examlayoutterms')
@section('content')
   <style>
       .btn-success {
           border-radius: 0;
           box-shadow: 0 3px 4px #332d2d;
           text-transform: uppercase;
           font-size: 11px !important;
           letter-spacing: 1px;
           margin: 4px 0;
           border: solid 1px #0874fb;
           color: #fff;
           background-color: #0874fb;
           padding: 12px 10px;
           margin-top: 50px;!important;
       }
   </style>
    <section id="terms-area">
        <div class="container">
            <div class="inner-area">
                <h1>General Instructions</h1>
                <p id="msg" style="color: red"></p>
                <ul>
                        <li><i class="fa fa-circle-o"></i> Test </li>
                        <li><i class="fa fa-circle-o"></i> &nbsp; Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident,
                            <p><span class="not-ans-area"></span> &nbsp; not-answered</p>
                            <p><span class="mark-area"></span> &nbsp; Marked</p>
                            <p><span class="ans-area"></span>  &nbsp; Answered</p>
                            <p><span class="not-atten-area"></span> &nbsp; Answered</p>
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident.
                        </li>
                </ul>

                <div class="radio">
                    <input type="radio" name="radio1" id="radio1" value="accept">
                    <label for="radio1">Accept</label>
                </div>
                <div class="radio">
                    <input type="radio" name="radio1" id="radio2" value="decline">
                    <label for="radio2">Decline</label>
                </div>

            </div>
            <div class="area2">
                <input class="form-check-input" type="checkbox" id="autoSizingCheck2"> the computer provided to me is in proper
                working condition. i have read and understood the instructions given above.
            </div>

            <div class="col-md-12 text-center">
            <br>

                {{--<button class="btn btn-success" id="start_exam"><i class="fa fa-arrow-circle-down"></i> Start exam</button>--}}
                <a href="{{route('exam::start_exam')}}" id="start_exam" class="btn-success"><i class="fa fa-arrow-circle-down"></i> Start exam</a>
            </div>

        </div>
    </section>

    @push('scripts')
    <script>
        $('#start_exam').click(function(){
            var data =  $('input[type=checkbox]').prop('checked');
            var accept = $("input[name='radio1']:checked").val();
            if(data && accept=='accept'){
                location.href='{{route('exam::start_exam')}}';
                var d = new Date();
                sessionStorage.setItem("date",d);
            }else{
                var msg = 'Please , You should check the checkbox and accpted.';
                $('#msg').empty().append(msg);
            }

        });

        /*Inspect element off and right click off view source off*/

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
        /*Lose focus*/
        {{--$(window).on("blur focus", function(e) {--}}
        {{--    var prevType = $(this).data("prevType");--}}

        {{--    if (prevType != e.type) {   //  reduce double fire issues--}}
        {{--        switch (e.type) {--}}
        {{--            case "blur":--}}
        {{--                window.location.href="<?php  echo route('exam::exam_logout'); ?>";--}}
        {{--                break;--}}
        {{--            case "focus":--}}
        {{--                break;--}}
        {{--        }--}}
        {{--    }--}}

        {{--    $(this).data("prevType", e.type);--}}
        {{--})--}}



    </script>

    @endpush
@endsection
