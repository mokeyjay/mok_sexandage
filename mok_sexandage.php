<?php
/*
Plugin Name: 性别和吧龄限制
Version: 1.0
Plugin URL: http://www.mokeyjay.com
Description: 可设定限制性别、吧龄
Author: mokeyjay
Author Email: i@mokeyjay.com
Author URL: http://www.mokeyjay.com
For: V3.8+
*/
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}

function mok_sexandage_check()
{
    if(ROLE != 'admin' && ROLE != 'vip'){
        $opt = json_decode(option::get('mok_sexandage'), TRUE);
        global $baidu_name; // 引用云签获取到的、经过转义处理的百度用户名
        $baidu_name = str_replace('\\\'', '\'', str_replace('\\\\', '\\', $baidu_name)); // 反转义

        $c = new wcurl('http://tieba.baidu.com/home/get/panel?ie=utf-8&un=' . urlencode($baidu_name), array('User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'));
        $json = $c->get();
        $c->close();
        $json = json_decode($json, TRUE);
        if(isset($json['data']['sex']) && isset($json['data']['tb_age'])){
            // 验证性别
            if($opt['sex']){
                if($opt['sex'] == 1){ // 妹子
                    if($json['data']['sex'] != 'female') msg('经检测你不是妹子，无法绑定！');
                } else { // 纯爷们儿
                    if($json['data']['sex'] != 'male') msg('经检测你不是纯爷们儿，无法绑定！');
                }
            }
            // 验证吧龄
            if($json['data']['tb_age'] < $opt['age_greater'] || $json['data']['tb_age'] >= $opt['age_less']){
                msg('你的吧龄不符合条件，无法绑定！');
            }
        } else {
            msg('获取当前百度账号的性别、吧龄失败，无法绑定！');
        }
    }
}

addAction('baiduid_set_2', 'mok_sexandage_check');