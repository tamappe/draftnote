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