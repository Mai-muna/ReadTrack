<?php
require __DIR__.'/includes/auth.php';
session_destroy();
header('Location: /ReadTrack/index.php');
