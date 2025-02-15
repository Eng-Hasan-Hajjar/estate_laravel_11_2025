<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;


class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

     /**
     * العلاقة بين الأدوار والمستخدمين
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function syncPermissions(array $permissions)
    {
        // تحويل الأسماء إلى IDs إذا تم تمرير أسماء الصلاحيات
        $permissionIds = [];
        foreach ($permissions as $permission) {
            if (is_string($permission)) {
                $permission = Permission::firstOrCreate(['name' => $permission]);
            }
            $permissionIds[] = $permission->id;
        }

        // مزامنة الصلاحيات مع الدور
        $this->permissions()->sync($permissionIds);
    }


}
