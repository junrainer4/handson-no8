<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../models/Faculty.php';

class FacultyController {

    private $model;

    public function __construct($conn) {
        $this->model = new Faculty($conn);
    }

    private function clean($val) {
        return htmlspecialchars(strip_tags(trim($val ?? '')));
    }

    private function getPostData() {
        return [
            'fname'    => $this->clean($_POST['fname']    ?? ''),
            'mname'    => $this->clean($_POST['mname']    ?? ''),
            'lname'    => $this->clean($_POST['lname']    ?? ''),
            'age'      => (int)($_POST['age']             ?? 0),
            'gender'   => $this->clean($_POST['gender']   ?? ''),
            'address'  => $this->clean($_POST['address']  ?? ''),
            'position' => $this->clean($_POST['position'] ?? ''),
            'salary'   => (float)($_POST['salary']        ?? 0),
        ];
    }

    public function index() {
        $msg = $_GET['msg'] ?? '';
        $faculty = $this->model->getAll();
        require __DIR__ . '/../views/list.php';
    }

    public function create() {
        $errors = [];
        $data   = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->getPostData();
            $errors = Faculty::validate($data);

            if (empty($errors)) {
                if ($this->model->create($data)) {
                    header('Location: index.php?msg=created');
                    exit;
                }
            }
        }

        require __DIR__ . '/../views/create.php';
    }

    public function edit($id) {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->getPostData();
            $errors = Faculty::validate($data);

            if (empty($errors)) {
                if ($this->model->update($id, $data)) {
                    header('Location: index.php?msg=updated');
                    exit;
                }
            }
        } else {
            $data = $this->model->getById($id);
            if (!$data) {
                header('Location: index.php');
                exit;
            }
        }

        require __DIR__ . '/../views/edit.php';
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->delete($id);
        }
        header('Location: index.php?msg=deleted');
        exit;
    }
}