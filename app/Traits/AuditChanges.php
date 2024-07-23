<?php

namespace App\Traits;

use App\Models\User;

trait AuditChanges
{
    public static function bootAuditChanges()
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                // detect if called from seeder
                if (auth()->check()) {
                    $model->created_by = auth()->user()->id;
                }
            }
            if (!$model->isDirty('updated_by')) {
                if (auth()->check()) {
                    $model->updated_by = auth()->user()->id;
                }
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                if (auth()->check()) {
                    $model->updated_by = auth()->user()->id;
                }
            }
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'bootSoftDeletes')) {
                if (!$model->isDirty('deleted_by')) {
                    if (auth()->check()) {
                        if (isset($model->ignoreDeletedBy) && $model->ignoreDeletedBy) {
                            // do nothing
                        } else {
                            $model->deleted_by = null;
                        }
                    }
                }
            }
        });

        if(method_exists(static::class, 'bootSoftDeletes')) {
            static::restoring(function ($model) {
                if (!$model->isDirty('deleted_by')) {
                    if (auth()->check()) {
                        if (isset($model->ignoreDeletedBy) && $model->ignoreDeletedBy) {
                            // do nothing
                        } else {
                            $model->deleted_by = auth()->user()->id;
                        }
                    }
                }
            });
        }

    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
