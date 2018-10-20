@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新しいToDo
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- new task form -->
                    <form action="{{url('/task/edit')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}

                    <!-- id -->
                        <div class="form-group">
                            <input type="hidden" name="id" id="task-id" value="{{$task->id}}">
                        </div>
                    <!-- name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">{{Config::get('const.memo_title')}}</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{$task->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-text" class="col-sm-3 control-label">Contents:</label>
                            <div class="col-md-8"><!-- col-md-8:幅8 -->
                                <textarea class="form-control" rows="5" id="comment" name="text">{{$task->text}}</textarea><!-- rows:高さ -->
                            </div>
                        </div>

                        <!-- edit button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-edit"></i>更新する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection