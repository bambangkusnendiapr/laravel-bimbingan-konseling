<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $with = ['pelanggaran', 'student', 'teacher'];
    protected $dates = ['tanggal'];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
