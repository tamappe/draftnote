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
                    <form action="{{url('task')}}" method="post" class="form-horizontal">
                    {{csrf_field()}}

                    <!-- name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">title</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="task-name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-text" class="col-sm-3 control-label">Contents</label>
                            <div class="col-md-8"><!-- col-md-8:幅8 -->
                                <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
                                <!-- rows:高さ -->
                            </div>
                        </div>

                        <!-- add button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>ToDoを作成する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <button class="btn btn-default" data-toggle="modal" data-target="#modal1">
                <i class="fa fa-btn fa-plus"></i>新規プロジェクトの作成
            </button>

            @include('layouts.modal')

            @if($current_project_id != null)
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        {{\App\Project::find($current_project_id)->title}} <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach($projects as $project)
                            @if($project->id != $current_project_id)
                                <li><a href="{{ url('task/change/' .$project->id) }}">{{ $project->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

        <!-- 現在のタスク -->
            @if(count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        現在のToDo
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <thead>
                            <th class="col-xs-3 col-ms-3 col-md-8 col-lg-8">ToDo</th>
                            <th class="col-xs-1 col-ms-1 col-md-1 col-lg-1">&nbsp;</th>
                            <th class="col-xs-1 col-ms-1 col-md-1 col-lg-1">&nbsp;</th>
                            </thead>

                            <tbody>
                            @foreach($tasks as $task)
                                @include('layouts.tablebody', ['task' => $task])
                            @endforeach
                            </tbody>
                        </table>
                        {{--{{ $tasks->links() }}--}}
                    </div>
                </div>
            @endif
            {{ $tasks->links() }}
        </div>
    </div>
@endsection