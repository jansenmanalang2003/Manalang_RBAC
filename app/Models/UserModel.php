<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    // A. Added role_id to allowed fields for RBAC
    protected $allowedFields = [
        'role_id', // Critical for assigning student/teacher/admin
        'name', 
        'email', 
        'password', 
        'student_id', 
        'course', 
        'year_level', 
        'section', 
        'phone', 
        'address', 
        'profile_image', 
        'created_at'
    ];

    // B. RBAC Join Method
    /**
     * Fetches a user and joins the roles table to get the role name string.
     * Used by AuthController to set session['user']['role'].
     */
    public function getUserWithRole(string $email)
    {
        return $this->select('users.*, roles.name as role_name, roles.label as role_label')
                    ->join('roles', 'roles.id = users.role_id')
                    ->where('users.email', $email)
                    ->first();
    }

    // C. Custom updateProfile method
    /**
     * Updates the user profile data.
     */
    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }
}