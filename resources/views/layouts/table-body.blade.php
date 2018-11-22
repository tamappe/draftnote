@if(count($tasks) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            現在のChekera
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <thead>
                <th class="col-xs-3 col-ms-3 col-md-8 col-lg-8">Chekera</th>
                <th class="col-xs-1 col-ms-1 col-md-1 col-lg-1">&nbsp;</th>
                <th class="col-xs-1 col-ms-1 col-md-1 col-lg-1">&nbsp;</th>
                </thead>

                <tbody>
                @foreach($tasks as $task)
                    @php $row = 'hidden_row'.$task->id; @endphp
                    <tr>
                        <td class="table-text" onclick="show_hide_row('{{$row}}');">
                            <div>{{ $task->name }}</div>
                        </td>
                        <td>
                            <form action="{{ url('task/' .$task->id) }}" method="post">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-edit"></i>done
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('task/edit/' .$task->id) }}" method="get">
                                {{ csrf_field() }}

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>編集
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr id="{{$row}}" class="hidden_row">
                        <td><textarea class="form-control" rows="5" id="comment" name="text"
                                      style="border:none; background-color: white;"
                                      readonly>{{$task->text}}</textarea></td>
                        <td>
                            <form action="{{ url('task/' .$task->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>削除
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--{{ $tasks->links() }}--}}
        </div>
    </div>
@endif