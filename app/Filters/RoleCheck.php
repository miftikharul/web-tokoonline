<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Periksa apakah pengguna sudah login
        if (!$session->get('is_logged_in')) {
            return redirect()->route('admin.login')->with('errors', ['You must be logged in to access this page']);
        }

        // Jika role diperlukan, periksa apakah pengguna memiliki role yang sesuai
        if ($arguments && is_array($arguments) && isset($arguments[0])) {
            $requiredRole = $arguments[0];
            if ($session->get('user_role') !== $requiredRole) {
                return redirect()->route('admin.login')->with('errors', ['Access denied']);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }
}
