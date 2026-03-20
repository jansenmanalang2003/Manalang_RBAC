<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StudentController extends BaseController
{
    /**
     * This method MUST be named 'dashboard' to match your route
     */
    public function dashboard()
    {
        $data = [
            'title' => 'Student Dashboard',
            'user'  => session()->get('user')
        ];

        // Ensure this view file actually exists at app/Views/student/dashboard.php
        return view('student/dashboard', $data);
    }
}