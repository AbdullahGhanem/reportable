<?php namespace Misfits\Reportable\Traits;

use Ghanem\Reportable\Models\Report;
use Illuminate\Database\Eloquent\Model;

trait Reportable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * @param $data
     * @param Model $reportable
     *
     * @return $this
     */
    public function report($data, Model $reportable)
    {
        $report = (new Report())->fill(array_merge($data, [
            'reporter_id' => $reportable->id,
            'reporter_type' => get_class($reportable),
        ]));

        $this->reports()->save($report);

        return $report;
    }
}
