<?php
// phpcs:ignoreFile -- this fail is generated by Laravel
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Auth\Models\User;


class ModelHasRoles extends Model
{
    protected $primaryKey = 'role_id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_has_roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['model_type', 'model_id'];

    public $timestamps = FALSE;

    public function user()
    {
        return $this->belongsTo(User::class, 'model_id');
    }

}
