<?php
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}

function callback_init()
{
    option::set('mok_sexandage', json_encode(array('sex'=>0, 'age_greater' => 0, 'age_less' => 999)));
}

function callback_remove()
{
    option::del('mok_sexandage');
}