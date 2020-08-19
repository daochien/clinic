<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SqlDebugProvider extends ServiceProvider
{
    public function register()
    {
        if (env('SQL_DEBUG', false)) {
            Event::listen(
                QueryExecuted::class,
                function (QueryExecuted $query) {
                    // Format binding data for sql insertion
                    foreach ($query->bindings as $i => $binding) {
                        if ($binding instanceof \DateTime) {
                            $query->bindings[ $i ] = $binding->format('\'Y-m-d H:i:s\'');
                        } else {
                            if (is_string($binding)) {
                                $query->bindings[ $i ] = "'$binding'";
                            }
                        }
                    }

                    // Insert bindings into query
                    $boundSql = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
                    $boundSql = vsprintf($boundSql, $query->bindings);

                    Log::debug(
                        "TIME - {$query->time}ms\n" .
                        "                                   BOUND QUERY: $boundSql;"
                    );
                }
            );
        }
    }
}
