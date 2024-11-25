<?php
function pass_hash($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}

function pass_verify($password, $pass_hash)
{
    return password_verify($password, $pass_hash);
}
