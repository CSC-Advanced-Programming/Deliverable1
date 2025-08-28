<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ProjectController extends BaseController {
    protected $db;
    public function __construct(){ $this->db = new JsonDB("projects.json"); }

    public function index(){ return $this->response->setJSON($this->db->all()); }
    public function show($id){ return $this->response->setJSON($this->db->find($id) ?? []); }
    public function create(){ $id=$this->db->insert($this->request->getJSON(true)); return $this->response->setJSON(['id'=>$id]); }
    public function update($id){ $this->db->update($id,$this->request->getJSON(true)); return $this->response->setJSON(['updated'=>$id]); }
    public function delete($id){ $this->db->delete($id); return $this->response->setJSON(['deleted'=>$id]); }
}
