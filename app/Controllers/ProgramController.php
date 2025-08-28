<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ProgramController extends BaseController {
    protected $db;
    public function __construct(){ $this->db = new JsonDB("programs.json"); }

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
            'title' => 'Programs',
            'active' => 'programs',
            'programs' => $this->db->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Programs']
            ]
        ];
        return view('programs/index', $data);
    }

    private function webShow($id) {
        $program = $this->db->find($id);
        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found');
        }

        $data = [
            'title' => 'Program Details',
            'active' => 'programs',
            'program' => $program,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Programs', 'url' => '/programs'],
                ['label' => $program['name']]
            ]
        ];
        return view('programs/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'national_alignment' => $this->request->getPost('national_alignment'),
                'focus_areas' => $this->request->getPost('focus_areas'),
                'phases' => $this->request->getPost('phases')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/programs')->with('success', 'Program created successfully');
        }

        $data = [
            'title' => 'Create Program',
            'active' => 'programs',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Programs', 'url' => '/programs'],
                ['label' => 'Create']
            ]
        ];
        return view('programs/create', $data);
    }

    private function webUpdate($id) {
        $program = $this->db->find($id);
        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'national_alignment' => $this->request->getPost('national_alignment'),
                'focus_areas' => $this->request->getPost('focus_areas'),
                'phases' => $this->request->getPost('phases')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/programs')->with('success', 'Program updated successfully');
        }

        $data = [
            'title' => 'Edit Program',
            'active' => 'programs',
            'program' => $program,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Programs', 'url' => '/programs'],
                ['label' => 'Edit ' . $program['name']]
            ]
        ];
        return view('programs/edit', $data);
    }

    private function webDelete($id) {
        $program = $this->db->find($id);
        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Program not found');
        }

        $this->db->delete($id);
        return redirect()->to('/programs')->with('success', 'Program deleted successfully');
    }
}
