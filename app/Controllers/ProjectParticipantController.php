<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ProjectParticipantController extends BaseController {
    protected $db;
    protected $projectDb;
    protected $participantDb;

    public function __construct(){
        $this->db = new JsonDB("project_participants.json");
        $this->projectDb = new JsonDB("projects.json");
        $this->participantDb = new JsonDB("participants.json");
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
        $assignments = $this->db->all();
        $projects = $this->projectDb->all();
        $participants = $this->participantDb->all();

        // Enrich assignments with project and participant data
        foreach ($assignments as &$assignment) {
            $project = array_filter($projects, fn($p) => $p['id'] == $assignment['project_id']);
            $participant = array_filter($participants, fn($p) => $p['id'] == $assignment['participant_id']);

            $assignment['project'] = $project ? reset($project) : null;
            $assignment['participant'] = $participant ? reset($participant) : null;
        }

        $data = [
            'title' => 'Project Assignments',
            'active' => 'assignments',
            'assignments' => $assignments,
            'projects' => $projects,
            'participants' => $participants,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Assignments']
            ]
        ];
        return view('project_participants/index', $data);
    }

    private function webShow($id) {
        $assignment = $this->db->find($id);
        if (!$assignment) {
            return redirect()->to('/project-participants')->with('error', 'Assignment not found');
        }

        $project = $this->projectDb->find($assignment['project_id']);
        $participant = $this->participantDb->find($assignment['participant_id']);

        $data = [
            'title' => 'Assignment Details',
            'active' => 'assignments',
            'assignment' => $assignment,
            'project' => $project,
            'participant' => $participant,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Assignments', 'url' => '/project-participants'],
                ['label' => 'Details']
            ]
        ];
        return view('project_participants/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'project_id' => $this->request->getPost('project_id'),
                'participant_id' => $this->request->getPost('participant_id'),
                'role' => $this->request->getPost('role'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'responsibilities' => $this->request->getPost('responsibilities'),
                'workload_percentage' => $this->request->getPost('workload_percentage')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/project-participants')->with('success', 'Participant assigned to project successfully');
        }

        $data = [
            'title' => 'Assign Participant to Project',
            'active' => 'assignments',
            'projects' => $this->projectDb->all(),
            'participants' => $this->participantDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Assignments', 'url' => '/project-participants'],
                ['label' => 'New Assignment']
            ]
        ];
        return view('project_participants/create', $data);
    }

    private function webUpdate($id) {
        $assignment = $this->db->find($id);
        if (!$assignment) {
            return redirect()->to('/project-participants')->with('error', 'Assignment not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'project_id' => $this->request->getPost('project_id'),
                'participant_id' => $this->request->getPost('participant_id'),
                'role' => $this->request->getPost('role'),
                'start_date' => $this->request->getPost('start_date'),
                'end_date' => $this->request->getPost('end_date'),
                'responsibilities' => $this->request->getPost('responsibilities'),
                'workload_percentage' => $this->request->getPost('workload_percentage')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/project-participants')->with('success', 'Assignment updated successfully');
        }

        $data = [
            'title' => 'Edit Assignment',
            'active' => 'assignments',
            'assignment' => $assignment,
            'projects' => $this->projectDb->all(),
            'participants' => $this->participantDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Assignments', 'url' => '/project-participants'],
                ['label' => 'Edit']
            ]
        ];
        return view('project_participants/edit', $data);
    }

    private function webDelete($id) {
        $assignment = $this->db->find($id);
        if (!$assignment) {
            return redirect()->to('/project-participants')->with('error', 'Assignment not found');
        }

        $this->db->delete($id);
        return redirect()->to('/project-participants')->with('success', 'Assignment removed successfully');
    }
}
