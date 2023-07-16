<?php
require_once 'rest/config/protect.php';
with('login.php', "scope");
$page = "periods";

include "head.php";
include "wrapper.php";

include "logoutModal.php";
include "tail.php";