<?php

namespace Ericc70\ExpressOpinionLite\install;


declare(strict_types=1);



class Database
{
    public static function installQueries(): array
    {
        $queries = [];

        $queries[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_question (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `content` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`),
           
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

        $queries[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_response (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `content` VARCHAR(255) NOT NULL,
            `question_id` INT(11) NOT NULL,
            PRIMARY KEY (`id`),
           
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

        $queries[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_vote_history (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `created_at` DATETIME NOT NULL,
            `user_id` INT(11) NOT NULL,
             PRIMARY KEY (`id`),
                  
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

        $queries[] =  'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_vote (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `question_id` INT(11) NOT NULL,
            `response_id` INT(11) NOT NULL
            `created_at` DATETIME NOT NULL,
            PRIMARY KEY (`id`),
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
        return $queries;
    }

    public static function unistallQueries() : array
    {
        $q = [];

        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_question';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_response';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_vote_history';
        $q[] = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'ec_expressopinions_vote';
        return $q;
    }
}
