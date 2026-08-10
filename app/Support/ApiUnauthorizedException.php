<?php

namespace App\Support;

use RuntimeException;

/**
 * Thrown when the CPNC API rejects the current token (expired / invalid).
 */
class ApiUnauthorizedException extends RuntimeException
{
}
