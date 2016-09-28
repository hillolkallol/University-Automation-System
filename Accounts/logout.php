<?php

require 'referer.php';

session_destroy();

header('Location: '.$http_referer);

?>