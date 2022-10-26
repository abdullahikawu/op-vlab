<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseExperiment extends Model
{
	use HasFactory;
    protected $table = 'course_experiment';
    public $incrementing = false;

    public function experiments()
    {
        return $this->belongsTo(Experiment::class, 'experiment_id');
    }

    public function getExperimentAttribute() {
        $experiments = Experiment::find($this->experiment_id);
        if(!is_null($experiments)){
            return $experiments;
        }else{
            return '';
        }
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    protected $appends = ['experiment'];
}
