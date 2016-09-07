<?php
const MYSQL_HOST = 'localhost'; //127.0.0.1
const MYSQL_USER = 'root';
const MYSQL_PASS = '';
const MYSQL_DB = 'blog';
const MYSQL_ENCD = 'utf8'; //encoding
const MYSQL_PORT = 3306;
const DB_DRIVER = 'mysql';
$conn = new PDO(
    DB_DRIVER . ":dbname=" . MYSQL_DB . ";host=" . MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASS
);