<?php

class BaseController
{
    /**
     * Render a view file with optional data.
     *
     * @param string $viewPath Path to the view file (e.g., 'items/add').
     * @param array $data Data to pass to the view.
     * @return void
     */
    protected function render(string $viewPath, array $data = [])
    {
        // Extract data to variables for use in the view
        extract($data);

        // Path to the view file
        $viewFile = __DIR__ . '/../views/' . $viewPath . '.php';

        if (file_exists($viewFile)) {
            // Include the layout and inject the view
            include __DIR__ . '/../views/layout.php';
        } else {
            echo "View file not found: $viewPath";
        }
    }
}
?>