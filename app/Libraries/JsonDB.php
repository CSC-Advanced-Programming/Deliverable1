<?php namespace App\Libraries;

use RuntimeException;

class JsonDB {
    private string $path;
    private array $data = [];

    /**
     * @throws RuntimeException
     */
    public function __construct(string $filename) {
        $dir = WRITEPATH . 'data';

        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }
        }

        $this->path = $dir . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($this->path)) {
            if (file_put_contents($this->path, '[]') === false) {
                throw new RuntimeException("Unable to create database file: {$this->path}");
            }
        }

        $this->load();
    }

    /**
     * @throws RuntimeException
     */
    private function load(): void
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException("Database file is not readable: {$this->path}");
        }

        $contents = file_get_contents($this->path);
        if ($contents === false) {
            throw new RuntimeException("Could not read database file: {$this->path}");
        }

        if (trim($contents) === '') {
            $this->data = [];
            return;
        }

        $decodedData = json_decode($contents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("Invalid JSON in database file: {$this->path}. Error: " . json_last_error_msg());
        }

        // Ensure data is always an array to prevent errors in consumers.
        $this->data = is_array($decodedData) ? $decodedData : [];
    }

    /**
     * @throws RuntimeException
     */
    private function save(): void
    {
        $json = json_encode($this->data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new RuntimeException("Failed to encode data to JSON. Error: " . json_last_error_msg());
        }

        if (file_put_contents($this->path, $json, LOCK_EX) === false) {
            throw new RuntimeException("Unable to write to database file: {$this->path}");
        }
    }

    public function all(): array {
        return $this->data;
    }

    public function find($id): ?array {
        foreach ($this->data as $row) {
            if (isset($row['id']) && $row['id'] == $id) {
                return $row;
            }
        }
        return null;
    }

    public function insert(array $data) {
        // Safely get the next ID, even if some records don't have an 'id'.
        $ids = array_column($this->data, 'id');
        $data['id'] = $ids ? max($ids) + 1 : 1;
        $this->data[] = $data;
        $this->save();
        return $data['id'];
    }

    public function update($id, array $newData): void {
        $updated = false;
        foreach ($this->data as &$row) {
            if (isset($row['id']) && $row['id'] == $id) {
                $row = array_merge($row, $newData, ['id' => (int)$id]);
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->save();
        }
    }

    public function delete($id): void {
        $initialCount = count($this->data);
        $this->data = array_values(array_filter($this->data, static fn($r) => !isset($r['id']) || $r['id'] != $id));

        if (count($this->data) < $initialCount) {
            $this->save();
        }
    }
}
