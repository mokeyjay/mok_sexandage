<?php
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}
$opt = option::get('mok_sexandage');
$opt = json_decode($opt, TRUE);
?>
<div>
    <?php if($_GET['save'] == 'ok'): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>保存设置成功！</strong>
        </div>
    <?php endif; ?>
    <form action="plugins/mok_sexandage/apis.php" method="post">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width:40%">参数</th>
                <th style="width:60%">值</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>性别限制<br/><br/>只有这些性别的百度账号才能在本站绑定</td>
                <td>
                    <label><input type="radio" name="sex" value="0" <?php echo $opt['sex'] == 0 ? 'checked' : '' ?>> 不限制</label><br>
                    <label><input type="radio" name="sex" value="1" <?php echo $opt['sex'] == 1 ? 'checked' : '' ?>> 妹子</label><br>
                    <label><input type="radio" name="sex" value="2" <?php echo $opt['sex'] == 2 ? 'checked' : '' ?>> 纯爷们儿</label>
                </td>
            </tr>
            <tr>
                <td>吧龄限制<br/><br/>满足以下吧龄条件的百度账号才能在本站绑定<br>支持1位小数</td>
                <td>
                    吧龄 大于等于&nbsp;
                    <input type="text" class="form-control" name="age_greater" value="<?php echo $opt['age_greater'] ?>">
                    <br>
                    吧龄 小于&nbsp;
                    <input type="text" class="form-control" name="age_less" value="<?php echo $opt['age_less'] ?>">
                </td>
            </tr>
            </tbody>
        </table>

        <input type="submit" class="btn btn-primary" value="保存设置">
    </form>
</div>