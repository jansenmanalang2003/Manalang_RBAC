<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    /**
     * Helper method to get User ID from the nested session structure
     */
    private function getSessionUserId()
    {
        $sessionUser = session()->get('user');
        return $sessionUser['id'] ?? null;
    }

    /**
     * 4.1 show() — Display Profile
     */
    public function show()
    {
        $userId = $this->getSessionUserId();
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Session expired. Please log in.');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found.');
        }

        // We pass the full user object from the database to the view
        $data['user'] = $user;
        return view('profile/show', $data);
    }

    /**
     * 4.2 edit() — Show Edit Form
     */
    public function edit()
    {
        $userId = $this->getSessionUserId();
        
        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        $data['user'] = $user;
        $data['errors'] = session()->getFlashdata('errors') ?? [];

        return view('profile/edit', $data);
    }

    /**
     * 4.3 update() — Process Form Submission
     */
    public function update()
    {
        $userId = $this->getSessionUserId();
        
        if (!$userId) {
            return redirect()->to('/login');
        }

        $user = $this->userModel->find($userId);

        // 1. Validation Rules
        $rules = [
            'name'        => 'required|min_length[3]',
            'email'       => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'student_id'  => 'permit_empty|min_length[3]',
            'course'      => 'permit_empty',
            'year_level'  => 'permit_empty|numeric',
            'phone'       => 'permit_empty',
            'address'     => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Prepare Data
        $updateData = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'student_id' => $this->request->getPost('student_id'),
            'course'     => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section'    => $this->request->getPost('section'),
            'phone'      => $this->request->getPost('phone'),
            'address'    => $this->request->getPost('address'),
        ];

        // 3. Image Upload Logic
        $file = $this->request->getFile('profile_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imgRules = [
                'profile_image' => 'is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'
            ];

            if ($this->validate($imgRules)) {
                // Delete old image if it's not the default
                if (!empty($user['profile_image']) && $user['profile_image'] !== 'default.png') {
                    $oldPath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                    if (file_exists($oldPath)) { @unlink($oldPath); }
                }

                $newName = 'avatar_' . $userId . '_' . time() . '.' . $file->getExtension();
                $file->move(FCPATH . 'uploads/profiles/', $newName);
                $updateData['profile_image'] = $newName;
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        // 4. Update Database
        // Note: Ensure your UserModel has an updateProfile method or use standard update()
        $this->userModel->update($userId, $updateData);

        // 5. Sync Session (Update the nested 'user' array so the Navbar updates too)
        $sessionUser = session()->get('user');
        $sessionUser['name'] = $updateData['name'];
        session()->set('user', $sessionUser);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
    }
}