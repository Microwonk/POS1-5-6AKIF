<?php

require_once "BStation.php";
require_once "Database.php";
require_once "DatabaseObject.php";
class BMessung implements DatabaseObject
{
    private int $m_id;
    private string $m_zeitpunkt;
    private int $m_messwert;
    private int $s_id;
    private ?BStation $station = null;

    public function insert()
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO messungen (m_zeitpunkt, m_messwert, s_id) values (?, ?, ?)");
        $stmt->execute([$this->m_zeitpunkt, $this->m_messwert, $this->s_id]);
        Database::disconnect();
        return $db->lastInsertId();
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public static function get($id)
    {
        // TODO: Implement get() method.
    }

    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM messungen");
        $stmt->execute();
        Database::disconnect();
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getMId(): int
    {
        return $this->m_id;
    }

    public function setMId(int $m_id): void
    {
        $this->m_id = $m_id;
    }

    public function getMZeitpunkt(): string
    {
        return $this->m_zeitpunkt;
    }

    public function setMZeitpunkt(string $m_zeitpunkt): void
    {
        $this->m_zeitpunkt = $m_zeitpunkt;
    }

    public function getMMesswert(): int
    {
        return $this->m_messwert;
    }

    public function setMMesswert(int $m_messwert): void
    {
        $this->m_messwert = $m_messwert;
    }

    public function getSId(): int
    {
        return $this->s_id;
    }

    public function setSId(int $s_id): void
    {
        $this->s_id = $s_id;
    }

    public function getStation(): ?BStation
    {
        if ($this->station == null) {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM stationen WHERE s_id = ?");
            $stmt->execute([$this->s_id]);
            $this->station = $stmt->fetchObject(BStation::class);
        }
        return $this->station;
    }

    public function setStation(?BStation $station): void
    {
        $this->station = $station;
    }
}