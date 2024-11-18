<?php

namespace de\xqueue\maileon\api\client\dataextensions;

/**
 * A type descriptor class for attribute definitions.
 *
 * The supported data types are string, double, float, integer, boolean,
 * date, timestamp, contact email, contact external id
 *
 **/
class DataType
{
    public static $STRING;
    public static $DOUBLE;
    public static $FLOAT;
    public static $INTEGER;
    public static $BOOLEAN;
    public static $DATE;
    public static $TIMESTAMP;
    public static $CONTACT_EMAIL;
    public static $CONTACT_EXTERNAL_ID;

    public static $initialized = false;

    /**
     *
     * @var string $value
     *  A string that describes the datatype. Valid values are "string", "double", "float",
     *  "integer", "boolean", "date", "timestamp", "contact_email" and "contact_external_id"
     */
    public $value;

    /**
     * Creates a new DataType object.
     *
     * @param string $value
     *  a string describing the data type. Valid values are "string", "double", "float",
     *  "integer", "boolean", "date", "timestamp", "contact_email" and "contact_external_id"
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public static function init()
    {
        if (!self::$initialized) {
            self::$STRING = new DataType("STRING");
            self::$DOUBLE = new DataType("DOUBLE");
            self::$FLOAT = new DataType("FLOAT");
            self::$INTEGER = new DataType("INTEGER");
            self::$BOOLEAN = new DataType("BOOLEAN");
            self::$DATE = new DataType("DATE");
            self::$TIMESTAMP = new DataType("TIMESTAMP");
            self::$CONTACT_EMAIL = new DataType("CONTACT_EMAIL");
            self::$CONTACT_EXTERNAL_ID = new DataType("CONTACT_EXTERNAL_ID");
            self::$initialized = true;
        }
    }

    /**
     * @return string
     *  the type descriptor string of this DataType. Can be "string", "double", "float",
     *  "integer", "boolean", "date", "timestamp", "contact_email" and "contact_external_id"
     */
    public function getValue()
    {
        return $this->value;
    }
}

DataType::init();