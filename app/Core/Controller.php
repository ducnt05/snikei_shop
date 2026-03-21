<?php
namespace App\Core;

class Controller
{
    /**
     * Render a view.
     *
     * @param string $view View path under app/views (without .php)
     * @param array $data Data to extract into view scope
     */
    protected function view(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    /**
     * Redirect to a different path under the app.
     */
    protected function redirect(string $path): void
    {
        $base = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '';
        header('Location: ' . $base . '/' . ltrim($path, '/'));
        exit;
    }

    /**
     * Ensure the current user is logged in.
     */
    protected function requireAuth(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    /**
     * Ensure the current user is an admin.
     */
    protected function requireAdmin(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('login');
        }
    }
}

