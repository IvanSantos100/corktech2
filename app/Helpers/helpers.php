<?php

function checkPermission($permissions)
{
    $userAccess = getMyPermission(auth()->user()->is_permission);
    foreach ($permissions as $key => $value) {
        if ($value == $userAccess) {
            return true;
        }
    }
    return false;
}

function getMyPermission($id)
{
    switch ($id) {
        case 1:
            return 'nacional';
            break;
        case 2:
            return 'distribuidora';
            break;
        default:
            return 'revenda';
            break;
    }
}

