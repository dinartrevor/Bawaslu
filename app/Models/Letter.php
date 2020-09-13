<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use DB;
class Letter extends Model
{
    protected $fillable = ['start_date','end_date','place_duty','year','information_a','information_b','categories','month','category'];
    public function employee_variant() 
    {
        return $this->hasMany(EmployeeLetter::class, 'letter_id','id')
        ->join('employees','employee_letters.employee_id','=','employess.id');
    }
    public function employee(): BelongsToMany
    {
        $pivotTable = EmployeeLetter::class;
        $relatedModel = Employee::class;
        return $this->belongsToMany($relatedModel, $pivotTable, 'letter_id', 'employee_id');
    }
    public function employee_first(): BelongsToMany
    {
        $pivotTable = EmployeeLetter::class;
        $relatedModel = Employee::class;
        return $this->belongsToMany($relatedModel, $pivotTable, 'letter_id', 'employee_id')->limit(1);
    }
}
