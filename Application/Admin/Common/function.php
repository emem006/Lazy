<?php
/**
 * @param $status
 * @return bool|string
 * 是否回复
 */
function message_status($status) {
    switch ($status) {
        case 0  : return    '未回复';     break;
        case 1  : return    '已回复';     break;
        default : return    false;     break;
    }
}