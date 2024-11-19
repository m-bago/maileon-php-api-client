<?php

namespace de\xqueue\maileon\api\client\dataextensions;

/**
 * The wrapper class for a Maileon Data Extension's Retention Policy.
 */
class RetentionPolicy
{
    public static $NONE;
    public static $EXTENSION_DATE;
    public static $EXTENSION_DURATION;
    public static $EXTENSION_DURATION_RENEW_ON_MODIFICATION;
    public static $RECORDS_DURATION;
    private static $initialized = false;

    public $type;

    /**
     * Constructor initializing the Retention Policy's type.
     *
     * @param string $type
     * The type to use for the constructed Retention Policy.
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * Initialization method for Retention Policy types. Must be called once in the beginning.
     */
    public static function init()
    {
        if (!self::$initialized) {
            self::$NONE = new RetentionPolicy("NONE");
            self::$EXTENSION_DATE = new RetentionPolicy("EXTENSION_DATE");
            self::$EXTENSION_DURATION = new RetentionPolicy("EXTENSION_DURATION");
            self::$EXTENSION_DURATION_RENEW_ON_MODIFICATION = new RetentionPolicy("EXTENSION_DURATION_RENEW_ON_MODIFICATION");
            self::$RECORDS_DURATION = new RetentionPolicy("RECORDS_DURATION");
            self::$initialized = true;
        }
    }

    /**
     * Get the type of this Retention Policy.
     *
     * @return string
     * The type of the Retention Policy object.
     */
    public function getType()
    {
        return $this->type;
    }

}
RetentionPolicy::init();