<?php

// eine 'record' klasse, die eine Frage darstellt (geladen aus json)
class Question {

    private string $question;
    private string $id;
    private array $options;

    public function __construct(?string $question, ?string $id, ?array $options) {
        $this->question = $question;
        $this->options = $options;
        $this->id = $id;
    }

    public function getQuestion(): string {
        return $this->question;
    }

    public function getOptions(): array {
        return $this->options;
    }

    public function getId(): string {
        return $this->id;
    }

    // erstellt ein Question Objekt aus einem assoziativen Array
    public static function fromJsonArr(array $arr) : Question {
        return new Question($arr["question"], $arr["id"], $arr["options"]);
    }
}