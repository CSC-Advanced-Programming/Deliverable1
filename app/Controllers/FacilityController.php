<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class FacilityController extends BaseController {
    protected $db;
    public function __construct(){ $this->db = new JsonDB("facilities.json"); }

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
            'title' => 'Facilities',
            'active' => 'facilities',
            'facilities' => $this->db->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Facilities']
            ]
        ];
        return view('facilities/index', $data);
    }

    private function webShow($id) {
        $facility = $this->db->find($id);
        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found');
        }

        $data = [
            'title' => 'Facility Details',
            'active' => 'facilities',
            'facility' => $facility,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Facilities', 'url' => '/facilities'],
                ['label' => $facility['name']]
            ]
        ];
        return view('facilities/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'location' => $this->request->getPost('location'),
                'type' => $this->request->getPost('type'),
                'capacity' => $this->request->getPost('capacity'),
                'description' => $this->request->getPost('description'),
                'contact_person' => $this->request->getPost('contact_person'),
                'contact_email' => $this->request->getPost('contact_email'),
                'contact_phone' => $this->request->getPost('contact_phone')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/facilities')->with('success', 'Facility created successfully');
        }

        $data = [
            'title' => 'Create Facility',
            'active' => 'facilities',
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Facilities', 'url' => '/facilities'],
                ['label' => 'Create']
            ]
        ];
        return view('facilities/create', $data);
    }

    private function webUpdate($id) {
        $facility = $this->db->find($id);
        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'location' => $this->request->getPost('location'),
                'type' => $this->request->getPost('type'),
                'capacity' => $this->request->getPost('capacity'),
                'description' => $this->request->getPost('description'),
                'contact_person' => $this->request->getPost('contact_person'),
                'contact_email' => $this->request->getPost('contact_email'),
                'contact_phone' => $this->request->getPost('contact_phone')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/facilities')->with('success', 'Facility updated successfully');
        }

        $data = [
            'title' => 'Edit Facility',
            'active' => 'facilities',
            'facility' => $facility,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Facilities', 'url' => '/facilities'],
                ['label' => 'Edit ' . $facility['name']]
            ]
        ];
        return view('facilities/edit', $data);
    }

    private function webDelete($id) {
        $facility = $this->db->find($id);
        if (!$facility) {
            return redirect()->to('/facilities')->with('error', 'Facility not found');
        }

        $this->db->delete($id);
        return redirect()->to('/facilities')->with('success', 'Facility deleted successfully');
    }
}
