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
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * Scope a query to get by search input.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetBySearch($query, string $search = '')
    {
        if (trim($search) != '') {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('isbn_code', 'like', "%$search%")
                ->orWhere('publication_year', 'like', "%$search%");
        }
        return $query;
    }

    /**
     * Scope a query to get by creator user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetByUserId($query, int $userId = 0)
    {
        if ($userId) {
            return $query->where('user_id', $userId);
        }
        return $query;
    }
}
