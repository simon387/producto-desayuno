<?php
require_once 'rest/config/protect.php';
with('login.php', "scope");
$page = "suppliers";

include "head.php";
include "wrapper.php";

include "logoutModal.php";
include "newSupplierModal.php";
include "tail.php";