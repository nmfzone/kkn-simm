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

if ( ! function_exists('paginate'))
{
    /**
     * Create a paginator for collection.
     *
     * @param  Collection  $data
     * @param  integer  $perPage
     * @param  string  $path
     * @param  string  $pageName
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    function paginate($data, $perPage = 5, $pageName = 'page', $path = '/')
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageResults = $data->slice(($currentPage-1) * $perPage, $perPage)->all();

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator($currentPageResults, count($data), $perPage, $currentPage);

        $paginator->setPageName($pageName);
        $paginator->setPath($path);

        return $paginator;
    }
}
