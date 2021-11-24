<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PharIo\Manifest\Author;

class Post extends Model
{
    use HasFactory, Sluggable;

    const IS_PUBLIC = 1;
    const IS_DRAFT = 0;


    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );

    }


    public function add($fields)
    {
        $post = new static();
        $post->fill($fields);
        $post->user_id = 1;

        $post->save();

        return $post;

    }


    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }


    public function remove()
    {
        Storage::delete('uploads/' . $this->image);
        $this->delete();
    }


    public function uploadImage($image)
    {
        if ($image == null)
            return;
        Storage::delete('uploads/' . $this->image);
        $fileName = Str::random(10) . '.' . $image->extension();
        $image->saveAs('uploads', $fileName);
        $this->image = $fileName;
        $this->save();

    }


    public function setCategory($id)
    {
        if ($id == null)
            throw new \Exception();

        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null)
            return;
        $this->tags()->sync($ids);
    }


    public function setFeatured()
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value == null)
            return $this->setStandart();
        return $this->setFeatured();
    }

    public function setDraft()
    {
        $this->status = self::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = self::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null)
            return $this->setDraft();
        return $this->setPublic();
    }


    public function getImage()
    {
        if ($this->image == null)
            return '/img/no-image.png';
        return '/uploads/' . $this->image;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
