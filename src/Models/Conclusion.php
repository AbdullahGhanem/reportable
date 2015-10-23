<?php namespace Ghanem\Reportable\Models;

use Illuminate\Database\Eloquent\Model;

class Conclusion extends Model
{
    /**
     * @var string
     */
    protected $table = 'reports_conclusions';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = ['meta' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conclusion()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function judge()
    {
        return $this->morphTo();
    }
}
