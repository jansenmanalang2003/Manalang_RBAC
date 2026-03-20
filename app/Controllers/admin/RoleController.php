<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\RawSql;

class RoleController extends BaseController
{
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
    }

    /**
     * List all roles and count how many users are assigned to each
     */
    public function index()
    {
        $builder = $this->db->table('roles');
        $builder->select('roles.*, COUNT(users.id) as user_count');
        $builder->join('users', 'users.role_id = roles.id', 'left');
        $builder->groupBy('roles.id');
        
        $data['roles'] = $builder->get()->getResultArray();
        return view('admin/roles/index', $data);
    }

    public function store()
    {
        $rules = [
            'name'  => 'required|is_unique[roles.name]|alpha_dash',
            'label' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid role data.');
        }

        $this->db->table('roles')->insert([
            'name'        => strtolower($this->request->getPost('name')),
            'label'       => $this->request->getPost('label'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('admin/roles')->with('success', 'Role created successfully.');
    }

    public function delete($id)
    {
        $role = $this->db->table('roles')->where('id', $id)->get()->getRow();

        // 1. Safety Check: Protect the Admin role
        if ($role->name === 'admin') {
            return redirect()->back()->with('error', 'The System Administrator role cannot be deleted.');
        }

        // 2. Clear role_id from users assigned to this role before deleting
        $this->db->table('users')->where('role_id', $id)->update(['role_id' => null]);
        $this->db->table('roles')->delete(['id' => $id]);

        return redirect()->to('admin/roles')->with('success', 'Role removed and users unassigned.');
    }
}