<?php

session_unset();
session_destroy();
session_start();
header('Location: ' . BASE_URL);