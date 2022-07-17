<?php

const DB_USER = 'root';
const DB_NAME = 'test';
const DB_HOST = 'localhost';
const DB_PASSWORD = 'root';

const ADMIN_IDS = [2];

function d(...$args)
{
    var_dump($args);
    die;
}