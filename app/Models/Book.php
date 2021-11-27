<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $fillable = [
        "title",
        "slug",
        "qoute",
        "author",
        "poster",
        "description",
        "category",
        "category_slug",
        "publisher",
        "published",
        "pages",
        "PDF_size",
        "language",
    ];

    public function scopeFilter($query)
    {
        if (request("search")) {
            $query
                ->where("title", "like", "%" . request("search") . "%")
                ->orWhere("description", "like", "%" . request("search") . "%");
        }
    }
    public function scopeCategory($query)
    {
        if (request("category")) {
            $query
                ->where("category_slug", request("category"));
        }
    }
}
