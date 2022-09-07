<?php

namespace App\Models\registration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

}
