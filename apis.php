<?php
require '../../init.php';
if (!defined('SYSTEM_ROOT') || ROLE != 'admin') {
    die('Insufficient Permissions');
}
if (isset($_POST['sex']) && isset($_POST['age_greater']) && isset($_POST['age_less'])) {
    option::set('mok_sexandage', json_encode(array(
        'sex'=>(int)$_POST['sex'],
        'age_greater' => $_POST['age_greater'],
        'age_less' => $_POST['age_less']
    )));
    Redirect('../../index.php?mod=admin:setplug&plug=mok_sexandage&save=ok');
}