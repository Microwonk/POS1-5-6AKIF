<?php

namespace controllers;
abstract class Controller
{
    public function render(string $view, $model = null): void
    {
        include 'views/layouts/top.php';
        include 'views/' . $view . '.php';
        include 'views/layouts/bottom.php';
    }

    protected function redirect(string $location): void
    {
        header('Location: index.php?r=' . $location);
    }

    public static function showError($title, $message): void
    {
    }

    /**
     * helper method for extraction POST data
     * @param $field
     * @return mixed|null
     */
    protected function getDataOrNull($field): mixed
    {
        return $_POST[$field] ?? null;
    }

}
