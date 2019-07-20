@extends('Exam.layouts.examlayoutnew')
@section('content')
    <section id="terms-area">
        <div class="container">
            <div class="inner-area">
                <h1>Exam Score</h1>
                <p id="msg" style="color: red"></p>
                <div class="content-wrapper">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title"></h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <p style="text-align: center;"></p>
                                        @if (Session::has('message'))
                                            <div class="alert alert-success" style="text-align: center;">{{ Session::get('message') }}</div>
                                        @endif
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Student Name</th>
                                                <th>Full Marks</th>
                                                <th>Exam Cutoff Score</th>
                                                <th>Marks Obtained</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0?>
                                            @foreach($info as $row)
                                                <?php $i++;
                                                $marks_data = \App\Model\ExamScoreBook::first();
                                                ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$marks_data->qualifying_exam_question_count}}</td>
                                                    <td>{{$marks_data->qualifying_exam_score_cutoff}}</td>
                                                    <td>{{$row->qualifying_exam_score}}</td>
                                                    <td>{{$row->qualifying_exam_status}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Sl no</th>
                                                <th>Student Name</th>
                                                <th>Full Marks</th>
                                                <th>Exam Cutoff Score</th>
                                                <th>Marks Obtained</th>
                                                <th>Status</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
            </div>
        </div>
    </section>

@endsection