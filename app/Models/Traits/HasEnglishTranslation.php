<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasEnglishTranslation
{
    public function translationEn()
    {
        $className = class_basename(static::class);
        $translationClass = "App\\Models\\{$className}En";
        $foreignKey = Str::snake($className) . '_id';

        return $this->hasOne($translationClass, $foreignKey);
    }

    public function getAttribute($key)
    {
        if (app()->getLocale() === 'en' && isset($this->translatableAttributes) && in_array($key, $this->translatableAttributes)) {
            $translation = $this->relationLoaded('translationEn')
                ? $this->getRelation('translationEn')
                : $this->translationEn;

            if ($translation && $translation->{$key} !== null) {
                $translatedVal = $translation->{$key};
                $originalVal = parent::getAttribute($key);
                if (is_array($originalVal) && is_array($translatedVal)) {
                    return array_replace_recursive($originalVal, $translatedVal);
                }
                return $translatedVal;
            }
        }
        return parent::getAttribute($key);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?? $this->getRouteKeyName();

        if ($field === 'slug') {
            $record = $this->whereSlug($value)->first();
            if ($record) {
                return $record;
            }
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->where(function ($q) use ($slug) {
            $q->where($this->getTable() . '.slug', $slug)
              ->orWhereHas('translationEn', function ($sub) use ($slug) {
                  $sub->where('slug', $slug);
              });
        });
    }
}