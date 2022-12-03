<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'isbn_code',
        'publication_year',
        'user_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created_by'];

    // ---------------- Accessors & Mutators ----------------

     /**
     * Get directly the username that created the book.
     *
     * @return string
     */
    public function getCreatedByAttribute(): string
    {
        return $this->user->name;
    }

    // --------------------- Relations ----------------------

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ------------------- Query Scopes --------------------

    /**
     * Scope a query to order by created date desc.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByDate($query)
    {
        return $query->orderBy('created_at','DESC');
    }
}
