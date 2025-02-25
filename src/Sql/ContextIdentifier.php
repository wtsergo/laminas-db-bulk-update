<?php

namespace Wtsergo\LaminasDbBulkUpdate\Sql;

/**
 * @template TInitial
 * @template TContext of \Stringable|string|int
 * @extends Identifier<TInitial>
 */
interface ContextIdentifier extends Identifier
{
    /**
     * @return TContext
     */
    public function context(): mixed;

    public function key(): string;
}
