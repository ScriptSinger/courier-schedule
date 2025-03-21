<?php

namespace Core;

class View
{
    /**
     * Путь к папке с шаблонами
     *
     * @var string
     */
    protected $viewPath;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Указываем путь к папке с представлениями
        $this->viewPath = __DIR__ . '/../resources/views/';
    }

    /**
     * Рендеринг шаблона
     *
     * @param string $view - Имя шаблона
     * @param array $data - Данные для передачи в шаблон
     * @return string
     */
    public function render(string $view, array $data = []): string
    {
        // Проверка на существование файла шаблона
        $viewFile = $this->viewPath . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new \Exception("Шаблон $view не найден");
        }

        // Извлекаем данные в локальные переменные
        extract($data);

        // Обработка шаблона
        ob_start();
        require $viewFile;
        return ob_get_clean();
    }
}
