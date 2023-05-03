<?php

namespace App\Controllers\Datatables;

use App\Controllers\BaseController;
use App\Models\TableModel;


class TableController extends BaseController
{

    // GET : /table/index
    public function index()
    {
        return view('tables');
    }

    // GET : /table/fetch/json
    public function fetchJsonData()
    {
        $tableModel = new TableModel();
        $data = $tableModel->findAll();
        $jsonData = [];

        foreach ($data as $key) {
            $json = [
                'id' => $key['id'],
                'nama' => $key['nama'],
                'email' => $key['email'],
                'no_hp' => $key['no_hp'],
            ];
            array_push($jsonData, $json);
        }

        return $this->response->setJSON($jsonData);
    }

    // GET : /table/getdata/$id
    public function getData($id)
    {
        // $id = $this->request->getVar('id');
        // var_dump($id);
        $tableModel = new TableModel();
        $getDataById = $tableModel->where('id', $id)->find();
        // var_dump($getDataById);
        if (!empty($getDataById)) {
            return $this->response->setJSON($getDataById);
        } else {
            return $this->response->setJSON($getDataById);
        }
    }

    // POST : /table/create/post
    public function createData()
    {
        $tableModel = new TableModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];
        $result = $tableModel->save($data);

        if (!empty($result)) {
            $data = ['status' => 'Data Successfully Inserted'];
            return $this->response->setJSON($data);
        } else {
            $data = ['status' => 'Failed to Insert Data'];
            return $this->response->setJSON($data);
        }
    }


    public function updateData($id)
    {
        $tableModel = new TableModel();
        $getUser = $tableModel->where('id', $id)->first();
        if (!empty($getUser)) {
            $updateData = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'status' => 'Data Successfully Updated',
            ];
            $tableModel->where('id', $id)->set($updateData)->update();
            return $this->response->setJSON($updateData);
        } else {
            $data = ['status' => 'There is no such data'];
            return $this->response->setJSON($data);
        }
    }

    public function deleteData($id)
    {
        $tableModel = new TableModel();
        $getUser = $tableModel->where('id', $id)->find();
        // var_dump($id);
        if (!empty($getUser)) {
            $tableModel->where('id', $id)->delete();
            $data = ['status' => 'Data Successfully Deleted'];
            return $this->response->setJSON($data);
        } else {
            $data = ['status' => 'Delete Data Fail'];
            return $this->response->setJSON($data);
        }
    }
}