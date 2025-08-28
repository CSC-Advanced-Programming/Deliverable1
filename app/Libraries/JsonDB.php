<?php namespace App\Libraries;

class JsonDB {
    private $path;

    public function __construct($filename) {
        $this->path = WRITEPATH . "data/" . $filename;
        if (!file_exists($this->path)) file_put_contents($this->path, "[]");
    }

    public function all() {
        return json_decode(file_get_contents($this->path), true);
    }

    public function find($id) {
        foreach ($this->all() as $row) {
            if ($row['id'] == $id) return $row;
        }
        return null;
    }

    public function insert($data) {
        $rows = $this->all();
        $data['id'] = count($rows) ? max(array_column($rows, 'id'))+1 : 1;
        $rows[] = $data;
        file_put_contents($this->path, json_encode($rows, JSON_PRETTY_PRINT));
        return $data['id'];
    }

    public function update($id, $newData) {
        $rows = $this->all();
        foreach ($rows as &$row) {
            if ($row['id'] == $id) {
                $row = array_merge($row, $newData, ['id'=>$id]);
            }
        }
        file_put_contents($this->path, json_encode($rows, JSON_PRETTY_PRINT));
    }

    public function delete($id) {
        $rows = array_values(array_filter($this->all(), fn($r)=>$r['id']!=$id));
        file_put_contents($this->path, json_encode($rows, JSON_PRETTY_PRINT));
    }
}
