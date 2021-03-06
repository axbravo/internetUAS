<?php

namespace Intranet\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
	use SoftDeletes;
	
    public function faculty(){
        return $this->belongsTo('Intranet\Models\Faculty', 'id_especialidad');
    }

    public function group(){
        return $this->belongsTo('Intranet\Models\Group', 'id_grupo');
    }

}
