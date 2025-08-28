<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class ServiceController extends BaseController {
    protected $db;
    protected $facilityDb;

    public function __construct(){
        $this->db = new JsonDB("services.json");
        $this->facilityDb = new JsonDB("facilities.json");
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
        $services = $this->db->all();
        $facilities = $this->facilityDb->all();

        // Add facility names to services
        foreach ($services as &$service) {
            $facility = array_filter($facilities, fn($f) => $f['id'] == $service['facility_id']);
            $service['facility_name'] = $facility ? reset($facility)['name'] : 'Unknown Facility';
        }

        $data = [
            'title' => 'Services',
            'active' => 'services',
            'services' => $services,
            'facilities' => $facilities,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Services']
            ]
        ];
        return view('services/index', $data);
    }

    private function webShow($id) {
        $service = $this->db->find($id);
        if (!$service) {
            return redirect()->to('/services')->with('error', 'Service not found');
        }

        $facility = $this->facilityDb->find($service['facility_id']);

        $data = [
            'title' => 'Service Details',
            'active' => 'services',
            'service' => $service,
            'facility' => $facility,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Services', 'url' => '/services'],
                ['label' => $service['name']]
            ]
        ];
        return view('services/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'facility_id' => $this->request->getPost('facility_id'),
                'category' => $this->request->getPost('category'),
                'cost' => $this->request->getPost('cost'),
                'duration' => $this->request->getPost('duration'),
                'requirements' => $this->request->getPost('requirements')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/services')->with('success', 'Service created successfully');
        }

        $data = [
            'title' => 'Create Service',
            'active' => 'services',
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Services', 'url' => '/services'],
                ['label' => 'Create']
            ]
        ];
        return view('services/create', $data);
    }

    private function webUpdate($id) {
        $service = $this->db->find($id);
        if (!$service) {
            return redirect()->to('/services')->with('error', 'Service not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'facility_id' => $this->request->getPost('facility_id'),
                'category' => $this->request->getPost('category'),
                'cost' => $this->request->getPost('cost'),
                'duration' => $this->request->getPost('duration'),
                'requirements' => $this->request->getPost('requirements')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/services')->with('success', 'Service updated successfully');
        }

        $data = [
            'title' => 'Edit Service',
            'active' => 'services',
            'service' => $service,
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Services', 'url' => '/services'],
                ['label' => 'Edit ' . $service['name']]
            ]
        ];
        return view('services/edit', $data);
    }

    private function webDelete($id) {
        $service = $this->db->find($id);
        if (!$service) {
            return redirect()->to('/services')->with('error', 'Service not found');
        }

        $this->db->delete($id);
        return redirect()->to('/services')->with('success', 'Service deleted successfully');
    }
}
