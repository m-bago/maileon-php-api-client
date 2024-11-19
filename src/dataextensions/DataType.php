<?php

namespace de\xqueue\maileon\api\client\dataextensions;

use de\xqueue\maileon\api\client\json\AbstractJSONWrapper;

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
            self::$STRING = new DataType("string");
            self::$DOUBLE = new DataType("double");
            self::$FLOAT = new DataType("float");
            self::$INTEGER = new DataType("integer");
            self::$BOOLEAN = new DataType("boolean");
            self::$DATE = new DataType("date");
            self::$TIMESTAMP = new DataType("timestamp");
            self::$CONTACT_EMAIL = new DataType("contact_email");
            self::$CONTACT_EXTERNAL_ID = new DataType("contact_external_id");
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