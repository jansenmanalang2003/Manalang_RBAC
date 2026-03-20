<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserAdminController extends BaseController
{
    /**
     * List all users with a dropdown to change their roles
     */
    public function index()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();

        $data['users'] = $userModel->select('users.*, roles.label as role_label')
                                   ->join('roles', 'roles.id = users.role_id', 'left')
                                   ->findAll();
        
        $data['roles'] = $db->table('roles')->get()->getResultArray();

        return view('admin/users/index', $data);
    }

    /**
     * Change a user's role
     */
    public function assignRole($id)
    {
        $userModel = new UserModel();
        $newRoleId = $this->request->getPost('role_id');

        // Safety Check: Prevent the currently logged-in Admin from changing their own role
        if ($id == session('user')['id']) {
            return redirect()->back()->with('error', 'You cannot change your own administrative permissions.');
        }

        $userModel->update($id, ['role_id' => $newRoleId]);

        return redirect()->to('admin/users')->with('success', 'User role updated successfully.');
    }
}