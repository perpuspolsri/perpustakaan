<?php
session()->set('isLoggedIn', true);
echo "Set session.<br>";

echo "isLoggedIn: ";
var_dump(session()->get('isLoggedIn'));
var_dump(session()->get('user_role'));
