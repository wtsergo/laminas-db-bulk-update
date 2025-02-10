<?php
/**
 * Copyright © EcomDev B.V. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace Wtsergo\LaminasDbBulkUpdate\Sql;

/**
 * @template TInitial
 */
interface Identifier
{
    /**
     * @return TInitial
     */
    public function initial(): mixed;
    public function findValue(array $resolved): int|string|array;
}
