<?php namespace Ghanem\Reportable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Reportable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports();

    /**
     * @param $data
     * @param Model $reportable
     *
     * @return mixed
     */
    public function report($data, Model $reportable);
}
