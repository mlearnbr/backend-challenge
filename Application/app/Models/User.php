<?php

namespace App\Models;

use App\Services\QualificaService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'msisdn',
        'name',
        'access_level',
        'password',
        'qualifica_id',
    ];

    /**
     * The attributes that should be attached to the model.
     *
     * @var array
     */
    protected $appends = [
        'external_id',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });

        static::retrieved(function ($model) {
            if ($model->id && !$model->qualifica_id) {
                DB::beginTransaction();
                try {
                    $service = new QualificaService();
                    $response = $service->searchUser($model->msisdn, $model->external_id);
                    $data = json_decode($response->getBody(), true)['data'];
                    $model->update([
                        'qualifica_id' => $data['id']
                    ]);

                    DB::commit();
                } catch (Exception $e) {
                    DB::rollback();
                }
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Accessor for External_id Attribute
     *
     * @return mixed
     */
    public function getExternalIdAttribute()
    {
        return $this->id;
    }
}
