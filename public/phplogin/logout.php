<?php
$LINK_HOME = "http://localhost/index.html";
session_start();
session_destroy();

header("Location: $LINK_HOME");
?>