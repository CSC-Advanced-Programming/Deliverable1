<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class OutcomeController extends BaseController {
    protected $db;
    protected $projectDb;

    public function __construct(){
        $this->db = new JsonDB("outcomes.json");
        $this->projectDb = new JsonDB("projects.json");
    }

    // API methods
    public function index(){
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            return $this->response->setJSON($this->db->all());
        }
        return $this->webIndex();
    }

    public function show($id){
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            return $this->response->setJSON($this->db->find($id) ?? []);
        }
        return $this->webShow($id);
    }

    public function create(){
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            $id = $this->db->insert($this->request->getJSON(true));
            return $this->response->setJSON(['id'=>$id]);
        }
        return $this->webCreate();
    }

    public function update($id){
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            $this->db->update($id, $this->request->getJSON(true));
            return $this->response->setJSON(['updated'=>$id]);
        }
        return $this->webUpdate($id);
    }

    public function delete($id){
        if ($this->request->isAJAX() || $this->request->getHeaderLine('Accept') === 'application/json') {
            $this->db->delete($id);
            return $this->response->setJSON(['deleted'=>$id]);
        }
        return $this->webDelete($id);
    }

    // Web UI methods
    private function webIndex() {
        $outcomes = $this->db->all();
        $projects = $this->projectDb->all();

        // Enrich outcomes with project data
        foreach ($outcomes as &$outcome) {
            if (!empty($outcome['project_id'])) {
                $project = array_filter($projects, fn($p) => $p['id'] == $outcome['project_id']);
                $outcome['project'] = $project ? reset($project) : null;
            }
        }

        $data = [
            'title' => 'Outcomes Management',
            'active' => 'outcomes',
            'outcomes' => $outcomes,
            'projects' => $projects,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Outcomes']
            ]
        ];
        return view('outcomes/index', $data);
    }

    private function webShow($id) {
        $outcome = $this->db->find($id);
        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found');
        }

        $project = null;
        if (!empty($outcome['project_id'])) {
            $project = $this->projectDb->find($outcome['project_id']);
        }

        $data = [
            'title' => 'Outcome Details',
            'active' => 'outcomes',
            'outcome' => $outcome,
            'project' => $project,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Outcomes', 'url' => '/outcomes'],
                ['label' => 'Details']
            ]
        ];
        return view('outcomes/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'title' => $this->request->getPost('title'),
                'outcome_type' => $this->request->getPost('outcome_type'),
                'description' => $this->request->getPost('description'),
                'project_id' => $this->request->getPost('project_id'),
                'status' => $this->request->getPost('status'),
                'impact' => $this->request->getPost('impact'),
                'commercial_value' => $this->request->getPost('commercial_value'),
                'date_achieved' => $this->request->getPost('date_achieved'),
                'notes' => $this->request->getPost('notes')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/outcomes')->with('success', 'Outcome created successfully');
        }

        $data = [
            'title' => 'Create New Outcome',
            'active' => 'outcomes',
            'projects' => $this->projectDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Outcomes', 'url' => '/outcomes'],
                ['label' => 'Create']
            ]
        ];
        return view('outcomes/create', $data);
    }

    private function webUpdate($id) {
        $outcome = $this->db->find($id);
        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'title' => $this->request->getPost('title'),
                'outcome_type' => $this->request->getPost('outcome_type'),
                'description' => $this->request->getPost('description'),
                'project_id' => $this->request->getPost('project_id'),
                'status' => $this->request->getPost('status'),
                'impact' => $this->request->getPost('impact'),
                'commercial_value' => $this->request->getPost('commercial_value'),
                'date_achieved' => $this->request->getPost('date_achieved'),
                'notes' => $this->request->getPost('notes')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/outcomes')->with('success', 'Outcome updated successfully');
        }

        $data = [
            'title' => 'Edit Outcome',
            'active' => 'outcomes',
            'outcome' => $outcome,
            'projects' => $this->projectDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Outcomes', 'url' => '/outcomes'],
                ['label' => 'Edit']
            ]
        ];
        return view('outcomes/edit', $data);
    }

    private function webDelete($id) {
        $outcome = $this->db->find($id);
        if (!$outcome) {
            return redirect()->to('/outcomes')->with('error', 'Outcome not found');
        }

        $this->db->delete($id);
        return redirect()->to('/outcomes')->with('success', 'Outcome deleted successfully');
    }
}
