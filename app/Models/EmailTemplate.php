<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class EmailTemplate extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'subject', 'body', 'variables'];

    protected $casts = ['variables' => 'array'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->doNotGenerateSlugsOnUpdate();
    }

    public function render(array $data): array
    {
        $subject = $this->subject;
        $body = $this->body;
        foreach ($data as $key => $value) {
            $subject = str_replace("{{$key}}", $value, $subject);
            $body = str_replace("{{$key}}", $value, $body);
        }
        return ['subject' => $subject, 'body' => $body];
    }
}
