<?php

require_once("task.php");

class TaskList {
    
    private array $tasks;

    private static $INSTANCE;

    // singleton pattern, dass man nur eine Instanz einer TaskList haben kann, und die initialisierung ensured ist.
    public static function get() : TaskList {
        return self::$INSTANCE ?? (self::$INSTANCE = new TaskList());
    }

    private function __construct() {
        if (isset($_COOKIE["tasks"])) {
            $this->tasks = unserialize($_COOKIE["tasks"]);
        } else {
            $this->tasks = [];
        }
    }

    public function getTasks(): array {
        return $this->tasks;
    }

    public function addTask(Task $task): void {
        $this->tasks[] = $task;
        $this->save();
    }

    public function removeTask(string $id): void {
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                unset($this->tasks[$index]);
                $this->save();
                return;
            }
        }
    }

    public function completeTask(string $id): void {
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                $this->tasks[$index]->setCompletion(Completion::COMPLETE);
                $this->save();
                return;
            }
        }
    }

    /**
     * Saves the task list to a cookie
     */
    public function save() {
        $tasks = serialize($this->tasks); // convert array to json format
        setcookie("tasks", $tasks, time() + 60 * 60 * 24 * 30, "/"); // cookie set to 30 days
    }
}