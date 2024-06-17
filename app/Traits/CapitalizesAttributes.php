<?php
namespace App\Traits;
trait CapitalizesAttributes
{
    protected static function bootCapitalizesAttributes()
    {
        static::saving(function ($model) {
            // Excluir ciertas columnas
            $excludedColumns = ['email', 'password'];

            // Convertir a mayúsculas las columnas no excluidas
            foreach ($model->attributes as $key => $value) {
                if (is_string($value) && !in_array($key, $excludedColumns)) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });
    }
}
