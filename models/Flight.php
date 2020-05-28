<?php

include_once("database/Database.php");

date_default_timezone_set("Africa/Lagos");

class Flight extends DbConnection
{
    // Class Properties
    private const TABLE = "flights";
    protected $table_fields = array('flight_id', 'flight_name', 'destination', 'duration', 'created_at', 'updated_at');

    // Insert Method (Create)
    public function create($flight_name, $destination, $duration)
    {
        $this->flight_name = $flight_name;
        $this->destination = $destination;
        $this->duration = $duration;
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO " . self::TABLE . "(" . $this->format_fields() . ") VALUES('" . $this->format_values() . "')";
        return $this->query($sql);
    }


    // Helper methods
    public function props()
    {
        // return get_object_vars($this);
        $props = [];
        foreach ($this->table_fields as $field) {
            if (property_exists($this, $field)) {
                $props[$field] = $this->$field;
            }
        }
        return $props;
    }

    private function format_fields()
    {
        return implode(", ", array_keys($this->props()));
    }
    private function format_values()
    {
        return implode("', '", array_values($this->props()));
    }
}

$vars = new Flight();
$vars->create("Flight 2", "Destination 2", 30000);
