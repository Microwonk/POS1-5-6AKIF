<?php

require_once 'DatabaseObject.php';
require_once 'Guest.php';
require_once 'Room.php';
class Reservation implements DatabaseObject {
    private int $id = 0;
    private string $from;
    private string $to;
    private int $room_id;
    private int $guest_id;
    private Room $room;
    private Guest $guest;

    // trait usage
    use DatabaseObjectValidationCommons;

    public function validate(): bool {
        return $this->validateCollisions()
            & $this->validateHelperLength('Von', 'from', $this->from, 10)
            & $this->validateHelperLength('Bis', 'to', $this->to, 10)
            & $this->validateHelperNumeric('Zimmer', 'room_id', $this->room_id, [1, 6969]) // mac zimmer nummer mal auf 6969 gesetzt
            & $this->room->validate()
            & $this->guest->validate();
    }

    // Kollisionserkennung
    private function recognizeCollisions(): bool {
        $db = Database::connect();
        $sql = "SELECT * FROM reservations WHERE room_id = ? AND ((`from` <= ? AND `to` >= ?) OR (`from` <= ? AND `to` >= ?))";
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->room_id, $this->from, $this->to, $this->from, $this->to]);
        $collisions = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();
        return count($collisions) == 0;
    }

    private function validateCollisions(): bool {
        if (!$this->recognizeCollisions()) {
            $this->errors['collision'] = "Kollision mit anderer Reservierung";
            return false;
        } else {
            return true;
        }
    }

    public function save(): bool {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                // known ID > 0 -> old object -> update
                $this->update();
            } else {
                // undefined ID -> new object -> create
                $this->id = $this->create();
            }
            return true;
        }
        return false;
    }

    public function create(): int {
        $db = Database::connect();
        $sql = "INSERT INTO reservations (`from`, `to`, room_id, guest_id) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->from, $this->to, $this->room->getNr(), $this->guest->getId()]);
        $lastId = $db->lastInsertId();  // get ID of new database-entry
        Database::disconnect();
        return $lastId;
    }

    public function update(): bool {
        $db = Database::connect();
        $sql = "UPDATE reservations SET `from` = ?, `to` = ?, room_id = ?, guest_id = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $success = $stmt->execute([$this->from, $this->to, $this->room->getNr(), $this->guest->getId(), $this->id]);
        Database::disconnect();
        return $success;
    }

    public static function get(int $id): ?static {
        $db = Database::connect();
        $sql = "SELECT * FROM reservations WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $item = $stmt->fetchObject(static::class);
        Database::disconnect();

        $item = $item !== false ? $item : null;

        // ORM nicht ganz möglich? -> manuell nachholen
        if (!is_null($item)) {
            $item->setGuest(Guest::get($item->getGuestId()));
            $item->setRoom(Room::get($item->getRoomNr()));
        }
        return $item;
    }

    public static function getAll(): array {
        $db = Database::connect();
        $sql = 'SELECT * FROM reservations';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();

        // ORM nicht ganz möglich? -> manuell nachholen
        foreach ($items as $item) {
            $item->setGuest(Guest::get($item->getGuestId()));
            $item->setRoom(Room::get($item->getRoomNr()));
        }

        return $items;
    }

    public static function delete(int $id): void {
        $db = Database::connect();
        $sql = "DELETE FROM reservations WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        Database::disconnect();
    }

    public function getRoomId(): int {
        return $this->room_id;
    }

    public function setRoomNr(int $room_id): void {
        $this->room_id = $room_id;
    }

    // Getters and setters
    public function getId(): int {
        return $this->id;
    }

    public function getFrom(): string {
        return $this->from;
    }

    /**
     * @throws Exception
     */
    public function fromAsDate(): DateTime {
        return new DateTime($this->from);
    }

    public function getTo(): string {
        return $this->to;
    }

    /**
     * @throws Exception
     */
    public function toAsDate(): DateTime {
        return new DateTime($this->to);
    }

    public function getRoom(): Room {
        return $this->room;
    }

    public function getRoomNr(): int {
        return $this->room_id;
    }

    public function getGuest(): Guest {
        return $this->guest;
    }

    public function getGuestId(): int {
        return $this->guest_id;
    }

    public function setGuestId(int $id): void
    {
        $this->guest_id = $id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setFrom(string $from): void {
        $this->from = $from;
    }

    public function setTo(string $to): void {
        $this->to = $to;
    }

    public function setRoom(Room $room): void {
        $this->room = $room;
        $this->room_id = $room->getNr();
    }

    public function setGuest(Guest $guest): void {
        $this->guest = $guest;
        $this->guest_id = $guest->getId();
    }

    /**
     * @throws Exception
     */
    public function getDurationInDays(): int {
        return $this->toAsDate()->diff($this->fromAsDate())->days;
    }
}