<?php

namespace App\Models;

use App\Models\Concerns\HasNameMarkerPivots;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, HasNameMarkerPivots;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps()
            ->withNameMarkers(parent: ['role_name' => 'name'], related: ['permission_name' => 'name']);
    }

    public function getPermissionIdsAttribute(): array
    {
        return $this->permissions()->pluck('permissions.id')->toArray();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user')->withTimestamps()
            ->withNameMarkers(parent: ['role_name' => 'name'], related: ['user_name' => 'name']);
    }

    public function isInactive(): bool
    {
        return ! $this->status;
    }

    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
}
