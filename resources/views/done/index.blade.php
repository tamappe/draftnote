@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
                    Complete Tasks
            <!-- Current Tasks -->
            @if(count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        現在のToDo
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <thead>
                            <th class="col-xs-3 col-ms-3 col-md-8 col-lg-8">ToDo</th>
                            </thead>

                            <tbody>
                            @foreach($tasks as $task)
                                @php $row = 'hidden_row'.$task->id; @endphp
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $task->name }}</div>
                                    </td>
                                    {{--<td>--}}
                                        {{--<form action="{{ url('task/' .$task->id) }}" method="post">--}}
                                            {{--{{ csrf_field() }}--}}

                                            {{--<button type="submit" class="btn btn-success">--}}
                                                {{--<i class="fa fa-edit"></i>done--}}
                                            {{--</button>--}}
                                        {{--</form>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

<script src="{{ asset('js/app.js') }}"></script>