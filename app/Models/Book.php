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
        "download_link2"
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters["search"] ?? false, fn ($query, $search) =>
        $query->where(
            fn ($query) =>
            $query->where("title", "like", "%" . $search . "%")
                ->orWhere("description", "like", "%" . $search . "%")
        ));

        $query->when(
            $filters["category"] ?? false,
            fn ($query, $category) =>
            $query->where("category_slug", "like", "%" . $category . "%")
        );
    }
}
