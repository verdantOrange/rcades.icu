<?php
/*
 * ddr-finder
 * Copyright (c) 2015 Andrés Cordero
 *
 * Web: https://github.com/Andrew67/ddr-finder
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Class PDOHelper
 * Provides a handle to the database connection, or creates it on first invocation.
 */
class PDOHelper {
    private static $connection = null;

    public static function getConnection() {
        if (null === self::$connection) {
            $db_conf = require '../db-conf.php';
            $dsn = "{$db_conf['driver']}:dbname={$db_conf['database']};host={$db_conf['host']}";
            self::$connection = new PDO($dsn, $db_conf['username'], $db_conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }
        return self::$connection;
    }
}