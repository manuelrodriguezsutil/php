<?php

spl_autoload_register(function ($class_name) {
    require_once "includes/class." . strtolower($class_name) . ".php";
});
