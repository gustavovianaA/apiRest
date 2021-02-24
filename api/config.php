<?php
    //Mysql
    const DBDRIVE = 'mysql';
    const DBHOST = 'localhost';
    const DBNAME = 'serie_login';
    const DBUSER = 'root';
    const DBPASS = '';
        
    const testet = 'dscfds';
     $_DELETE = array();
     $_PUT = array();

    if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'DELETE')) {
    parse_str(file_get_contents('php://input'), $_DELETE);
    }
if (!strcasecmp($_SERVER['REQUEST_METHOD'], 'PUT')) {
    parse_str(file_get_contents('php://input'), $_PUT);
}