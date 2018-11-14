@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    リクエストフォーム
                </div>
                <div class="panel-body">
                    管理人にChekeraで開発してほしい機能を送る事が出来ます
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- new task form -->
                    <form action="{{url('user_request')}}" method="post" class="form-horizontal">
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
                                <textarea class="form-control" rows="5" id="comment" name="text"></textarea><!-- rows:高さ -->
                            </div>
                        </div>

                        <!-- add button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>希望を伝える
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Current Tasks -->
            @if(count($user_requests) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        リクエスト一覧
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">

                            <thead>
                            <th class="col-xs-3 col-ms-3 col-md-8 col-lg-8">リクエスト</th>
                            <th class="col-xs-1 col-ms-1 col-md-1 col-lg-1">&nbsp;</th>
                            </thead>

                            <tbody>
                            @foreach($user_requests as $user_request)
                                @php $row = 'hidden_row'.$user_request->id; @endphp
                                <tr>
                                    <td class="table-text" onclick="show_hide_row('{{$row}}');">
                                        <div>{{ $user_request->name }}</div>
                                    </td>
                                    @if($user_request->user_id == $user_id)
                                        <td>
                                            <form action="{{ url('user_request/' .$user_request->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>削除
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                <tr id="{{$row}}" class="hidden_row">
                                    <td><textarea class="form-control" rows="5" id="comment" name="text" style="border:none; background-color: white;" readonly>{{$user_request->text}}</textarea></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--{{ $tasks->links() }}--}}
                    </div>
                </div>
            @endif
            {{ $user_requests->links() }}
        </div>
    </div>
@endsection