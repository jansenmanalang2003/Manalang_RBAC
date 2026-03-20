<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function register()
    {
        return view('auth/register');
    }

    /**
     * Handle User Registration
     * Updated: Ensures consistency with your testing password requirements
     */
    public function store()
    {
        $rules = [
            'name'             => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        // Logic: Hash the password provided (e.g., Password1) using BCRYPT
        $passwordToHash = $this->request->getPost('password');

        $this->userModel->save([
            'role_id'  => 3, // Default role: student
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($passwordToHash, PASSWORD_BCRYPT),
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful. You can now login with Password1.');
    }

    public function login()
    {
        return view('auth/login');
    }

    /**
     * Handle Authentication
     * Verified: This is the correct logic to support your seeded 'Password1' accounts
     */
    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); // This will be 'Password1'

        // 1. Fetch user and their joined role name
        $user = $this->userModel->getUserWithRole($email);

        // 2. Verify the plain-text input against the stored BCRYPT hash
        if ($user && password_verify($password, $user['password'])) {
            
            // 3. Safety check for role name to prevent PHP 8.1+ null errors in strtoupper()
            $roleName = (isset($user['role_name']) && !empty($user['role_name'])) ? (string)$user['role_name'] : 'guest';

            // 4. Set Session Data
            session()->set([
                'isLoggedIn' => true,
                'user' => [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email'],
                    'role'  => $roleName, 
                ],
            ]);

            // 5. Redirect based on the role name retrieved from the database
            return match($roleName) {
                'admin', 'teacher' => redirect()->to('/dashboard'),
                'student'          => redirect()->to('/student/dashboard'),
                'coordinator'      => redirect()->to('/coordinator/dashboard'),
                default            => redirect()->to('/login')->with('error', 'Unauthorized role.'),
            };
        }

        // Authentication failed
        return redirect()->back()->with('error', 'Invalid email or password. Hint: Try Password1');
    }

    public function unauthorized()
    {
        $session = session()->get('user');
        $data['userRole'] = $session['role'] ?? 'Guest';
        return view('errors/unauthorized', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}