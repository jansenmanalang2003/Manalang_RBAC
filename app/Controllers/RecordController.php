<?php

namespace App\Controllers;

use App\Models\RecordModel;
use CodeIgniter\Controller;

class RecordController extends BaseController
{
    protected $recordModel;

    public function __construct() {
        // Load the model and ensure the form helper is available for old() and validation
        $this->recordModel = new RecordModel();
        helper(['form', 'url']);
    }

    // 3.2 READ (Index)
    public function index() {
        $data = [
            'records' => $this->recordModel->findAll(),
            'title'   => 'Student Records List'
        ];
        return view('records/index', $data);
    }

    // 3.2 READ (Show Detail)
    public function show($id) {
        $data['record'] = $this->recordModel->find($id);
        
        if (!$data['record']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Record with ID $id not found.");
        }
        
        return view('records/show', $data);
    }

    // 3.1 CREATE (Form)
    public function create() {
        // Retrieve errors from session if redirected back from 'store'
        $data['errors'] = session()->getFlashdata('errors');
        return view('records/create', $data);
    }

    // 3.1 CREATE (Process)
    public function store() {
        $rules = [
            'name'   => 'required|min_length[3]|max_length[255]',
            'title'  => 'required|max_length[255]',
            'status' => 'required',
            'course' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->recordModel->save($this->request->getPost());
        
        return redirect()->to('/records')->with('success', 'New record added successfully!');
    }

    // 3.3 UPDATE (Edit Form)
    public function edit($id) {
        $data['record'] = $this->recordModel->find($id);
        
        if (!$data['record']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Retrieve errors from session if redirected back from 'update'
        $data['errors'] = session()->getFlashdata('errors');
        
        return view('records/edit', $data);
    }

    // 3.3 UPDATE (Process)
    public function update($id) {
        $rules = [
            'name'   => 'required|min_length[3]|max_length[255]',
            'title'  => 'required|max_length[255]',
            'status' => 'required',
            'course' => 'required'
        ];

        if (!$this->validate($rules)) {
            // withInput() allows old() to work, with('errors') passes the messages
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->recordModel->update($id, $this->request->getPost());
        
        return redirect()->to('/records')->with('success', 'Record updated successfully.');
    }

    // 3.4 DELETE
    public function delete($id) {
        // Verification that record exists before deletion
        if ($this->recordModel->find($id)) {
            $this->recordModel->delete($id);
            return redirect()->to('/records')->with('success', 'Record has been permanently removed.');
        }

        return redirect()->to('/records')->with('error', 'Record not found.');
    }
}