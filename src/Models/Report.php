<?php namespace Misfits\Reportable\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = ['meta' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reportable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reporter()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function conclusion()
    {
        return $this->hasOne(Conclusion::class);
    }

    /**
     * @return mixed
     */
    public function judge()
    {
        return $this->conclusion->judge;
    }

    /**
     * @param $data
     * @param Model $judge
     *
     * @return $this
     */
    public function conclude($data, Model $judge)
    {
        $conclusion = (new Conclusion())->fill(array_merge($data, [
            'judge_id' => $judge->id,
            'judge_type' => get_class($judge),
        ]));

        $this->conclusion()->save($conclusion);

        return $conclusion;
    }

    /**
     * @return array
     */
    public static function allJudges()
    {
        $judges = [];

        foreach (Conclusion::get() as $conclusion) {
            $judges[] = $conclusion->judge;
        }

        return $judges;
    }
}
