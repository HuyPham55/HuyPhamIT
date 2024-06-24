<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;
    public string $titleColumn = 'title';

    protected function dynamicTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getTranslated($this->titleColumn)
        )->shouldCache();
    }

    public function getTranslated(string $attribute): string
    {
        if ($this->{$attribute}) {
            return $this->{$attribute};
        }
        if (method_exists($this, 'getTranslation')) {
            foreach (config('lang') as $key => $details) {
                if ($key === app()->getLocale()) {
                    continue;
                }
                $data = $this->getTranslation($attribute, $key);
                if ($data) {
                    return $data;
                }
            }
        }
        return "";
    }

    public function formatDate(string $attribute): string
    {
        return $this->{$attribute} ? date_format($this->{$attribute}, "Y-m-d") : "";
    }
}
