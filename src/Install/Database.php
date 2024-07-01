<?php
declare(strict_types=1);
namespace Ericc70\Expressopinionlite\Install;

class Database
{
    public static function installQueries(): array
    {
        $queries = [];

        $queries[] = 'CREATE TABLE IF NOT EXISTS '. _DB_PREFIX_ . 'ec_expressopinionslite_question (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `content` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`)
           
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

        $queries[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_response (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `content` VARCHAR(255) NOT NULL,
            `question_id` INT(11) NOT NULL,
            PRIMARY KEY (`id`)
           
        )  ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

        $queries[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_vote_history (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `created_at` DATE NOT NULL,
            `user_id` INT(11) NOT NULL,
             PRIMARY KEY (`id`)
                  
        )  ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

        $queries[] =  'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_vote (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `question_id` INT(11) NOT NULL,
            `response_id` INT(11) NOT NULL,
            `created_at` DATE NOT NULL,
            PRIMARY KEY (`id`)
        )  ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

        return $queries;
    }

    public static function unistallQueries() : array
    {
        $q = [];

        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_question';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_response';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_vote_history';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinionslite_vote';
        return $q;
    }

    public static function insertData()
    {
        $q = [];
        $q[] = "INSERT INTO " . _DB_PREFIX_ . "ec_expressopinionslite_question (`content`) VALUES ('Votre question ici ?')";
        $q[] = "INSERT INTO " . _DB_PREFIX_ . "ec_expressopinionslite_response (`content`, `question_id`) VALUES ('Oui', 1)";
        $q[] = "INSERT INTO " . _DB_PREFIX_ . "ec_expressopinionslite_response (`content`, `question_id`) VALUES ('Peut-être', 1)";
        $q[] = "INSERT INTO " . _DB_PREFIX_ . "ec_expressopinionslite_response (`content`, `question_id`) VALUES ('Non', 1)";
        
        return $q;
    }
    
}
