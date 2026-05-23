<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'profile_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_perusahaan',
        'visi',
        'misi',
        'sejarah',
        'alamat',
        'email',
        'telepon',
    ];
}
