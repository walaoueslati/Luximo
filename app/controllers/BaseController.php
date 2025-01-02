<?php

class BaseController
{
    /**
     * Render a view file with optional data.
     *
     * @param string $viewPath 
     * @param array $data 
     * @return void
     */
    protected function render(string $viewPath, array $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../views/' . $viewPath . '.php';

        if (file_exists($viewFile)) {
            include __DIR__ . '/../views/layout.php';
        } else {
            echo "View file not found: $viewPath";
        }
    }
}
?>