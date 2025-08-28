<?php namespace App\Controllers;
use App\Libraries\JsonDB;

class EquipmentController extends BaseController {
    protected $db;
    protected $facilityDb;

    public function __construct(){
        $this->db = new JsonDB("equipment.json");
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
        $equipment = $this->db->all();
        $facilities = $this->facilityDb->all();

        // Add facility names to equipment
        foreach ($equipment as &$item) {
            $facility = array_filter($facilities, fn($f) => $f['id'] == $item['facility_id']);
            $item['facility_name'] = $facility ? reset($facility)['name'] : 'Unknown Facility';
        }

        $data = [
            'title' => 'Equipment',
            'active' => 'equipment',
            'equipment' => $equipment,
            'facilities' => $facilities,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Equipment']
            ]
        ];
        return view('equipment/index', $data);
    }

    private function webShow($id) {
        $equipment = $this->db->find($id);
        if (!$equipment) {
            return redirect()->to('/equipment')->with('error', 'Equipment not found');
        }

        $facility = $this->facilityDb->find($equipment['facility_id']);

        $data = [
            'title' => 'Equipment Details',
            'active' => 'equipment',
            'equipment' => $equipment,
            'facility' => $facility,
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Equipment', 'url' => '/equipment'],
                ['label' => $equipment['name']]
            ]
        ];
        return view('equipment/show', $data);
    }

    private function webCreate() {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'facility_id' => $this->request->getPost('facility_id'),
                'category' => $this->request->getPost('category'),
                'model' => $this->request->getPost('model'),
                'manufacturer' => $this->request->getPost('manufacturer'),
                'serial_number' => $this->request->getPost('serial_number'),
                'purchase_date' => $this->request->getPost('purchase_date'),
                'cost' => $this->request->getPost('cost'),
                'status' => $this->request->getPost('status'),
                'maintenance_schedule' => $this->request->getPost('maintenance_schedule'),
                'operating_instructions' => $this->request->getPost('operating_instructions')
            ];

            $id = $this->db->insert($data);
            return redirect()->to('/equipment')->with('success', 'Equipment added successfully');
        }

        $data = [
            'title' => 'Add Equipment',
            'active' => 'equipment',
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Equipment', 'url' => '/equipment'],
                ['label' => 'Add']
            ]
        ];
        return view('equipment/create', $data);
    }

    private function webUpdate($id) {
        $equipment = $this->db->find($id);
        if (!$equipment) {
            return redirect()->to('/equipment')->with('error', 'Equipment not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'facility_id' => $this->request->getPost('facility_id'),
                'category' => $this->request->getPost('category'),
                'model' => $this->request->getPost('model'),
                'manufacturer' => $this->request->getPost('manufacturer'),
                'serial_number' => $this->request->getPost('serial_number'),
                'purchase_date' => $this->request->getPost('purchase_date'),
                'cost' => $this->request->getPost('cost'),
                'status' => $this->request->getPost('status'),
                'maintenance_schedule' => $this->request->getPost('maintenance_schedule'),
                'operating_instructions' => $this->request->getPost('operating_instructions')
            ];

            $this->db->update($id, $data);
            return redirect()->to('/equipment')->with('success', 'Equipment updated successfully');
        }

        $data = [
            'title' => 'Edit Equipment',
            'active' => 'equipment',
            'equipment' => $equipment,
            'facilities' => $this->facilityDb->all(),
            'breadcrumb' => [
                ['label' => 'Dashboard', 'url' => '/'],
                ['label' => 'Equipment', 'url' => '/equipment'],
                ['label' => 'Edit ' . $equipment['name']]
            ]
        ];
        return view('equipment/edit', $data);
    }

    private function webDelete($id) {
        $equipment = $this->db->find($id);
        if (!$equipment) {
            return redirect()->to('/equipment')->with('error', 'Equipment not found');
        }

        $this->db->delete($id);
        return redirect()->to('/equipment')->with('success', 'Equipment deleted successfully');
    }
}
