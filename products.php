<?php
require_once 'rest/config/protect.php';
with('login.php', "scope");
$page = "products";

include "head.php";
include "wrapper.php";

include "logoutModal.php";
include "newProductModal.php";
include "tail.php";