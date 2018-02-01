<?php
namespace DesignMyNight\Laravel;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class RecursiveCollectionServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::macro('recursive', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return (new Collection($value))->recursive();
                }

                return $value;
            });
        });
    }
}
