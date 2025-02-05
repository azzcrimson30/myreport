<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFormat extends Model
{
    use HasFactory;

    protected $table='report_formats';

    protected $fillable = [
        'name','format'
    ];
}
