<?php

namespace de\xqueue\maileon\api\client\dataextensions;

/**
 * The wrapper class for a Maileon Data Extension's Delete Interval Unit.
 */
class DeleteIntervalUnit
{
    public static $DAYS;
    public static $WEEKS;
    public static $MONTH;
    private static $initialized = false;
    public $unit;

    /**
     * Constructor initializing the Delete Interval's unit.
     *
     * @param string $unit
     * The unit to use for the constructed Delete Interval.
     */
    public function __construct($unit = null)
    {
        $this->unit = $unit;
    }

    /**
     * Initialization method for Delete Interval units. Must be called once in the beginning.
     */
    public static function init()
    {
        if (!self::$initialized) {
            self::$DAYS = new DeleteIntervalUnit("DAYS");
            self::$WEEKS = new DeleteIntervalUnit("WEEKS");
            self::$MONTH = new DeleteIntervalUnit("MONTH");
            self::$initialized = true;
        }
    }

    /**
     * Get the unit of this Delete Interval.
     *
     * @return string
     * The unit of the Delete Interval.
     */
    public function getUnit()
    {
        return $this->unit;
    }
}

DeleteIntervalUnit::init();