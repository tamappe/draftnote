<!-- モーダルダイアログ -->
<div class="modal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-show="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">プロジェクト名</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&#215;</span>
                </button>
            </div><!-- /modal-header -->

            <!-- /プロジェクトフォームの作成 -->
            <form action="{{url('project')}}" method="post">
                {{ csrf_field() }}

                <div class="modal-body">
                    <input type="text" name="name" id="project-name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-btn fa-plus"></i>作成する
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                </div>
            </form>
            <!-- /プロジェクトフォームの作成、終了 -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->