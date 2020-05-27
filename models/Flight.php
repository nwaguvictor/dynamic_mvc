<?php

include_once("database/Database.php");

class Flight extends DbConnection
{
    // Class Properties
    private const TABLE = "flights";
    protected $flight_name = "name", $destination = "home", $duration = 3000;

    // Insert Method (Create)
    public function create($name, $des, $dur)
    {
        $sql = "INSERT INTO " . self::TABLE . "(" . self::format_fields() . ") VALUES('" . self::format_values() . "')";
        return $this->query($sql);
    }


    // Helper methods
    private static function props()
    {
        return get_object_vars(new self);
    }

    private static function format_fields()
    {
        return implode(", ", array_keys(self::props()));
    }
    public static function format_values()
    {
        return implode("', '", array_values(self::props()));
    }
}

$vars = new Flight();
$vars->create();
echo $vars::format_values();
