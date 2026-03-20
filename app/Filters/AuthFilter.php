<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Layer 1 Check: Is anyone logged in at all?
     * This runs before every other role-based filter.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Following your Step 3 logic: Reads session()->has('user')
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) 
    {
        // No action needed after the request
    }
}