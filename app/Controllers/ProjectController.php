<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ProjectController extends BaseController {
    protected $db;
    protected $programDb;
    protected $facilityDb;
    protected $participantDb;
    protected $outcomeDb;

    public function __construct(){
        $this->db = new JsonDB("projects.json");
        $this->programDb = new JsonDB("programs.json");
        $this->facilityDb = new JsonDB("facilities.json");
        $this->participantDb = new JsonDB("participants.json");
        $this->outcomeDb = new JsonDB("outcomes.json");
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
        $projects = $this->db->all();
        $programs = $this->programDb->all();
        $facilities = $this->facilityDb->all();

        // Add related data to projects
        foreach ($projects as &$project) {
            $program = array_filter($programs, fn($p) => $p['id'] == $project['program_id']);
            $project['program_name'] = $program ? reset($program)['name'] : 'Unknown Program';

            $facility = array_filter($facilities, fn($f) => $f['id'] == $project['facility_id']);
            $project['facility_name'] = $facility ? reset($facility)['name'] : 'Unknown Facility';
        }

        $data = [
            'title' => 'Projects',
            'active' => 'projects',
            'projects' => $projects,
            'programs' => $programs,
            'facilities' => $facilities,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Projects']
            ]
        ];
        return view('projects/index', $data);
    }

    private function webShow($id) {
        $project = $this->db->find($id);
        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found');
        }

        $program = $this->programDb->find($project['program_id']);
        $facility = $this->facilityDb->find($project['facility_id']);

        $data = [
            'title' => 'Project Details',
            'active' => 'projects',
            'project' => $project,
            'program' => $program,
            'facility' => $facility,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => $project['title']]
            ]
        ];
        return view('projects/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'program_id' => $this->request->getPost('program_id'),
                'facility_id' => $this->request->getPost('facility_id'),
                'title' => $this->request->getPost('title'),
                'nature_of_project' => $this->request->getPost('nature_of_project'),
                'description' => $this->request->getPost('description'),
                'innovation_focus' => $this->request->getPost('innovation_focus'),
                'prototype_stage' => $this->request->getPost('prototype_stage'),
                'testing_requirements' => $this->request->getPost('testing_requirements'),
                'commercialization_plan' => $this->request->getPost('commercialization_plan'),
                'status' => $this->request->getPost('status', 'Planning')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/projects')->with('success', 'Project created successfully');
        }

        $data = [
            'title' => 'Create Project',
            'active' => 'projects',
            'programs' => $this->programDb->all(),
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Create']
            ]
        ];
        return view('projects/create', $data);
    }

    private function webUpdate($id) {
        $project = $this->db->find($id);
        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'program_id' => $this->request->getPost('program_id'),
                'facility_id' => $this->request->getPost('facility_id'),
                'title' => $this->request->getPost('title'),
                'nature_of_project' => $this->request->getPost('nature_of_project'),
                'description' => $this->request->getPost('description'),
                'innovation_focus' => $this->request->getPost('innovation_focus'),
                'prototype_stage' => $this->request->getPost('prototype_stage'),
                'testing_requirements' => $this->request->getPost('testing_requirements'),
                'commercialization_plan' => $this->request->getPost('commercialization_plan'),
                'status' => $this->request->getPost('status')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/projects')->with('success', 'Project updated successfully');
        }

        $data = [
            'title' => 'Edit Project',
            'active' => 'projects',
            'project' => $project,
            'programs' => $this->programDb->all(),
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Edit ' . $project['title']]
            ]
        ];
        return view('projects/edit', $data);
    }

    private function webDelete($id) {
        $project = $this->db->find($id);
        if (!$project) {
            return redirect()->to('/projects')->with('error', 'Project not found');
        }

        $this->db->delete($id);
        return redirect()->to('/projects')->with('success', 'Project deleted successfully');
    }
}
