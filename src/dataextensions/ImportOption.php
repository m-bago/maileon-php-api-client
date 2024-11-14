<?php

namespace de\xqueue\maileon\api\client\dataextensions;

/**
 * Class ImportOption
 * Enum-like class defining possible import options for managing records.
 *
 * @author Milan Nagy <milan.nagy@xqueue.com>
 */
final class ImportOption
{
    public static $INSERT;
    public static $UPDATE;
    public static $UPSERT;
    public static $INSERT_IGNORE_DUPLICATES;
    public static $DELETE;

    private static $initialized = false;
    public $option;

    /**
     * ImportOption constructor.
     *
     * @param string $option
     */
    public function __construct($option)
    {
        $this->option = $option;
    }

    /**
     * Initializes the ImportOption types once.
     */
    public static function init()
    {
        if (!self::$initialized) {
            self::$INSERT = new ImportOption("INSERT");
            self::$UPDATE = new ImportOption("UPDATE");
            self::$UPSERT = new ImportOption("UPSERT");
            self::$INSERT_IGNORE_DUPLICATES = new ImportOption("INSERT_IGNORE_DUPLICATES");
            self::$DELETE = new ImportOption("DELETE");
            self::$initialized = true;
        }
    }

    /**
     * Get the string value of the ImportOption.
     *
     * @return string
     */
    public function getOption(): string
    {
        return $this->option;
    }
}

ImportOption::init();
