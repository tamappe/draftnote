@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新しいChekera
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
                                    <i class="fa fa-btn fa-plus"></i>Check it out
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(count($tasks) > 0)
                <button class="btn btn-default" data-toggle="modal" data-target="#modal-new">
                    <i class="fa fa-btn fa-plus"></i>新規プロジェクト
                </button>

                @include('layouts.modal-new')
                @php
                    // これをキーにしてプロジェクトのタイトルやidなどをセットしていく
                    $first_task = $tasks[0];
                @endphp
                @if($first_task->project != null && $first_task->project->user->current_project_id != null)
                    @include('layouts.modal-edit', ['project' => $first_task->project])
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            {{ $first_task->project->title}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach($first_task->project->user->projects as $project)
                                @if($project->id != $first_task->project->user->current_project_id)
                                    <li><a href="{{ url('task/change/' .$project->id) }}">{{ $project->title }}</a></li>
                                @endif
                            @endforeach
                            <li><a data-toggle="modal" data-target="#modal-edit">名前の編集</a></li>
                        </ul>

                        </button>
                    </div>
                @endif
            @endif

        <!-- 現在のタスク -->
            @include('layouts.table-body', ['tasks' => $tasks])
            {{ $tasks->links() }}
        </div>
    </div>
@endsection