<?php

require_once 'medoo/Medoo.php';
require_once 'menu.functions.php';
require_once 'user.functions.php';

use medoo\Medoo;

final class AdminFunctions
{

    private static $db_name = 'pitcernia';
    private static $db_server = 'localhost';
    private static $db_user = 'root';
    private static $db_passwd = '';

    /**
     * Outputs income for selected type:
     * - CURRENT_DAY
     * - CURRENT_MONTH
     * - TWELVE_PRIOR
     *
     * @param string $type
     * @return float
     */
    public static function GetIncomeFrom(string $type) {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $income = 0;

        switch ($type) {
            case "CURRENT_DAY":
                $income = floatval($db->select(
                    'income_from_current_day',  
                    '*'
                )[0]['orders_price']);
                break;
            case "CURRENT_MONTH":
                $income = floatval($db->select(
                    'income_from_current_month',
                    '*'
                )[0]['orders_price']);
                break;
            case "TWELVE_PRIOR":
                $income = floatval($db->select(
                    'income_from_twelve_prior_months',
                    '*'
                )[0]['orders_price']);
                break;
            default:
                throw new Error("No type provided!");
        }

        unset($db);

        return $income;
    }
}
