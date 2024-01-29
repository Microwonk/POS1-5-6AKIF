<?php

/// simple Task klasse, die einen Titel, 
/// eine Beschreibung, einen Completion 
/// Status und eine ID hat (plus getter setter)
class Task {
    private string $title;
    private string $description;
    private string $completion;
    private string $id;

    public function __construct(?string $title, ?string $description){
        $this->title = $title;
        $this->description = $description;
        $this->completion = Completion::INCOMPLETE;
        $this->id = uniqid();
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getCompletion(): string {
        return $this->completion;
    }

    public function setCompletion(string $completion): void {
        $this->completion = $completion;
    }

    public function getId(): string {
        return $this->id;
    }
}

// ab php 8.1 koennte man hier ein ENUM verwenden
class Completion {
    const COMPLETE = 'Complete';
    const INCOMPLETE = 'Incomplete';

    public static function getOptions(): array {
        return [
            self::COMPLETE,
            self::INCOMPLETE
        ];
    }
}

// wuerde dann so aussehen:
// enum Completion {
//     Complete,
//     Incomplete,
// }