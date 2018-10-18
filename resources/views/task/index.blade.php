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
                            <label for="task-name" class="col-sm-3 control-label">Todo</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control">
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
            <!-- TODO: Current Tasks -->
        </div>
    </div>
@endsection