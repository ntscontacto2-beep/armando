<?php
namespace App\Core;

class View {
    private string $layout;
    private string $basePath;

    public function __construct(string $layout) {
        $this->layout = $layout;
        // /app/Core  -> queremos /app
        $this->basePath = realpath(__DIR__ . '/..');
    }

    public function render(string $view, array $data = []): void {
        $viewFile   = realpath(__DIR__ . "/../Views/{$view}.php");
        $layoutFile = realpath(__DIR__ . "/../Views/{$this->layout}.php");

        if (!$viewFile) throw new \RuntimeException("Vista no encontrada: {$view}");
        $content = $this->capture($viewFile, $data);

        if ($layoutFile && is_file($layoutFile)) {
            $this->inject($layoutFile, ['content' => $content] + $data);
        } else {
            echo $content;
        }
    }


    private function capture(string $file, array $data): string {
        if (!is_file($file)) {
            throw new \RuntimeException("Vista no encontrada: {$file}");
        }
        extract($data, EXTR_OVERWRITE);
        ob_start();
        include $file;
        return ob_get_clean();
    }

    private function inject(string $file, array $data): void {
        extract($data, EXTR_OVERWRITE);
        include $file;
    }
}
