<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ParticipantController extends BaseController {
    protected $db;
    public function __construct(){ $this->db = new JsonDB("participants.json"); }

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
        $data = [
            'title' => 'Participants',
            'active' => 'participants',
            'participants' => $this->db->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Participants']
            ]
        ];
        return view('participants/index', $data);
    }

    private function webShow($id) {
        $participant = $this->db->find($id);
        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found');
        }

        $data = [
            'title' => 'Participant Details',
            'active' => 'participants',
            'participant' => $participant,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Participants', 'url' => '/participants'],
                ['label' => $participant['name']]
            ]
        ];
        return view('participants/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'organization' => $this->request->getPost('organization'),
                'position' => $this->request->getPost('position'),
                'expertise' => $this->request->getPost('expertise'),
                'bio' => $this->request->getPost('bio'),
                'status' => $this->request->getPost('status')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/participants')->with('success', 'Participant added successfully');
        }

        $data = [
            'title' => 'Add Participant',
            'active' => 'participants',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Participants', 'url' => '/participants'],
                ['label' => 'Add']
            ]
        ];
        return view('participants/create', $data);
    }

    private function webUpdate($id) {
        $participant = $this->db->find($id);
        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'organization' => $this->request->getPost('organization'),
                'position' => $this->request->getPost('position'),
                'expertise' => $this->request->getPost('expertise'),
                'bio' => $this->request->getPost('bio'),
                'status' => $this->request->getPost('status')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/participants')->with('success', 'Participant updated successfully');
        }

        $data = [
            'title' => 'Edit Participant',
            'active' => 'participants',
            'participant' => $participant,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Participants', 'url' => '/participants'],
                ['label' => 'Edit ' . $participant['name']]
            ]
        ];
        return view('participants/edit', $data);
    }

    private function webDelete($id) {
        $participant = $this->db->find($id);
        if (!$participant) {
            return redirect()->to('/participants')->with('error', 'Participant not found');
        }

        $this->db->delete($id);
        return redirect()->to('/participants')->with('success', 'Participant deleted successfully');
    }
}
