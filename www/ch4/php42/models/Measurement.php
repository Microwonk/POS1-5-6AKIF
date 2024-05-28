<?php
namespace models;

use DateTime;
use Exception;
use JsonSerializable;
use models\Database;
use models\DatabaseObject;
use models\Station;
use PDO;

class Measurement implements DatabaseObject, JsonSerializable
{
    private int $id;
    private string $time;
    private float $temperature;
    private float $rain;
    private int $station_id;   // ID of station
    private ?Station $station = null;      // ORM of station

    private array $errors = [];

    public function validate(): bool
    {
        return $this->validateTime() & $this->validateTemperature() & $this->validateRain() & $this->validateStationId();
    }

    /**
     * create or update an object
     * @return boolean true on success
     */
    public function save(): bool
    {
        if ($this->validate()) {
            if ($this->id != null && $this->id > 0) {
                $this->update();
            } else {
                $this->id = $this->create();
            }

            return true;
        }

        return false;
    }

    /**
     * Creates a new object in the database
     * @return integer ID of the newly created object (lastInsertId)
     */
    public function create(): int
    {
        $db = Database::connect();
        $sql = "INSERT INTO measurement (time, temperature, rain, station_id) values(?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->time, $this->temperature, $this->rain, $this->station_id));
        $lastId = $db->lastInsertId();
        Database::disconnect();
        return $lastId;
    }

    /**
     * Saves the object to the database
     */
    public function update(): bool
    {
        $db = Database::connect();
        $sql = "UPDATE measurement set time = ?, temperature = ?, rain = ?, station_id = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $ret = $stmt->execute(array($this->time, $this->temperature, $this->rain, $this->station_id, $this->id));
        Database::disconnect();
        return $ret;
    }

    public static function get($id): ?static
    {
        $db = Database::connect();
        $sql = "SELECT m.*, s.id, s.name, s.altitude, s.location
                FROM measurement m JOIN station s ON m.station_id = s.id where m.id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        if ($d == null) {
            return null;
        } else {
            $station = new Station();
            $station->setId($d['id']);
            $station->setName($d['name']);
            $station->setAltitude($d['altitude']);
            $station->setLocation($d['location']);
            $measurement = new Measurement();
            $measurement->setId($id);
            $measurement->setTime($d['time']);
            $measurement->setTemperature($d['temperature']);
            $measurement->setRain($d['rain']);
            $measurement->setStationId($d['station_id']);
            $measurement->setStation($station);
            return $measurement;
        }
    }

    public static function getAll(): array
    {
        $db = Database::connect();

        $sql = "SELECT * FROM measurement ORDER BY time ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();

        return $items;
    }

    /**
     * Get an array of objects from database
     * @param int $station_id
     * @return array array of objects or empty array
     */
    public static function getAllByStation(int $station_id): array
    {
        $measurements = [];
        $db = Database::connect();

        $sql = "SELECT * FROM measurement WHERE station_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$station_id]);
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
        Database::disconnect();
        return $items;
    }

    public static function delete(int $id): bool
    {
        $db = Database::connect();
        $sql = "DELETE FROM measurement WHERE id = ?";
        $stmt = $db->prepare($sql);
        $ret = $stmt->execute(array($id));
        Database::disconnect();
        return $ret;
    }

    private function validateTime(): bool
    {
        try {
            if ($this->time == '') {
                $this->errors['time'] = "Messzeitpunkt darf nicht leer sein";
                return false;
            } else if (new DateTime($this->time) > new DateTime()) {
                $this->errors['time'] = "Messzeitpunkt " . htmlspecialchars($this->time) . " darf nicht in der Zukunft liegen";
                return false;
            } else {
                unset($this->errors['time']);
                return true;
            }
        } catch (Exception $e) {
            $this->errors['time'] = "Messzeitpunkt " . htmlspecialchars($this->time) . " ungültig";
            return false;
        }
    }

    private function validateTemperature(): bool
    {
        if ($this->temperature < -50 || $this->temperature > 150) {
            $this->errors['temperature'] = "Temperatur ungueltig";
            return false;
        } else {
            unset($this->errors['temperature']);
            return true;
        }
    }

    private function validateRain(): bool
    {
        if ($this->rain < 0 || $this->rain > 10000) {
            $this->errors['rain'] = "Regenmenge ungueltig";
            return false;
        } else {
            unset($this->errors['rain']);
            return true;
        }
    }

    private function validateStationId(): bool
    {
        if (!is_numeric($this->station_id) && $this->station_id <= 0) {
            $this->errors['station_id'] = "StationID ungueltig";
            return false;
        } else {
            unset($this->errors['station_id']);
            return true;
        }
    }

    public function hasError($field): bool
    {
        return !empty($this->errors[$field]);
    }

    public function getError($field): array
    {
        return $this->errors[$field];
    }

    public function jsonSerialize()
    {
        $data = [
            "id" => intval($this->id),
            "time" => $this->time,
            "temperature" => round(doubleval($this->temperature), 2),
            "rain" => round(doubleval($this->rain), 2),
        ];

        if ($this->station_id != null) {
            $data['station_id'] = intval($this->station_id);      // include id
        }

        if ($this->station != null && is_object($this->station)) {
            $data['station'] = $this->station;      // include object
        }

        return $data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getTemperature(): mixed
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getRain(): float
    {
        return $this->rain;
    }

    /**
     * @param mixed $rain
     */
    public function setRain(mixed $rain): void
    {
        $this->rain = $rain;
    }

    public function getStationId(): int
    {
        return $this->station_id;
    }

    public function setStationId(int $station_id): void
    {
        $this->station_id = $station_id;
    }


    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(Station $station): void
    {
        $this->station = $station;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
