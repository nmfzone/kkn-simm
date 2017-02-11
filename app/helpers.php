<?php

if (! function_exists('resourceNames')) {
    /**
     * Get the array of name for the route resource.
     *
     * @param  string  $name
     * @return array
     */
    function resourceNames($name)
    {
        return [
            'index' => $name . '.index',
            'create' => $name . '.create',
            'store' => $name . '.store',
            'show' => $name . '.show',
            'edit' => $name . '.edit',
            'update' => $name . '.update',
            'destroy' => $name . '.destroy',
        ];
    }
}
