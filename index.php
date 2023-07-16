<?php
require_once 'rest/config/protect.php';
with('login.php', "scope");
$page = "dashboard";

include "head.php";
include "wrapper.php";

include "logoutModal.php";
include "newPeriodModal.php";
include "tail.php";