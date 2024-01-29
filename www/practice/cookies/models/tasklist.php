<?php

require_once("task.php");

class TaskList {
    
    /// array von [Task]'s
    private array $tasks;

    /// statische Variable fuer die Instanz der Klasse
    /// hier darf nicht der Typ angegeben werden (wieso auch immer? is halt PHP)
    /// also das darf man nicht machen: 
    /// private static TaskList $INSTANCE;
    /// wahrscheinlich weil die Instanz danach noch abgeaendert wird (in der get methode)
    private static $INSTANCE;
    // singleton pattern, dass man nur eine Instanz einer TaskList haben kann, und die initialisierung ensured ist.
    public static function get() : TaskList {
        return self::$INSTANCE ?? (self::$INSTANCE = new TaskList());
    }

    /// Konstruktor, der die tasks aus dem cookie laedt, sonst ein leeres array
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

    /// fuegt einen task hinzu und speichert die tasks im cookie
    public function addTask(Task $task): void {
        // kann man genau so mit array_push machen, ist geschmackssache
        // heisst:
        // array_push($this->tasks, $task);
        $this->tasks[] = $task;
        // save sollte hier immer aufgerufen werden,
        // damit man sich es ausserhalb der klasse nicht merken muss
        $this->save();
    }

    /// loescht einen task und speichert die tasks im cookie
    public function removeTask(string $id): void {
        // iterate over tasks and find the one with the given id
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                unset($this->tasks[$index]);
                // save sollte hier immer aufgerufen werden,
                // damit man sich es ausserhalb der klasse nicht merken muss
                $this->save();
                return;
            }
        }
    }

    /// complete einen task und speichert die tasks im cookie
    public function completeTask(string $id): void {
        // iterate over tasks and find the one with the given id
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                // found the task, set completion to complete
                $this->tasks[$index]->setCompletion(Completion::COMPLETE);
                $this->save();
                return;
            }
        }
    }

    /// speichert die tasks in einem cookie mittels
    /// serialize, das die tasks in einen string umwandelt
    /// mit json_encode sollte es theoretisch auch gehen, aber
    /// das wiederherstellen der Objekte ist dann etwas komplizierter
    public function save() {
        $tasks = serialize($this->tasks); // convert array to serialized format
        setcookie("tasks", $tasks, time() + 60 * 60 * 24 * 30, "/"); // cookie set to 30 days
    }
}