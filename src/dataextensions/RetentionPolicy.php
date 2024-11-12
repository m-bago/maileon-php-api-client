<?php

namespace de\xqueue\maileon\api\client\dataextensions;

class RetentionPolicy
{
    const NONE = "NONE";
    const EXTENSION_DATE = "EXTENSION_DATE";
    const EXTENSION_DURATION = "EXTENSION_DURATION";
    const EXTENSION_DURATION_RENEW_ON_MODIFICATION = "EXTENSION_DURATION_RENEW_ON_MODIFICATION";
    const RECORDS_DURATION = "RECORDS_DURATION";
}