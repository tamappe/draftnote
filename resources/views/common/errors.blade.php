@if(count($errors) > 0)

    <div class="alert alert-danger">
        <strong>エラーが発生しました。もう一度入力しなおしてください</strong>
        <br><br>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif