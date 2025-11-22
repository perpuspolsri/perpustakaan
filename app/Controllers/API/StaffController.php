<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\StaffModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class StaffController extends ResourceController
{
    protected $modelName = StaffModel::class;
    protected $format    = 'json';
    public function index()
    {
        try {
            $staffArr = $this->model->findAll();

            $staff = [];
            foreach ($staffArr as $s) {
                $medsos = explode(";", $s["medsos"]);
                $staff[] = [
                    "nip" => $s["nip"],
                    "email" => $s["email"],
                    "name" => $s["name"],
                    "role" => $s["role"],
                    "image" => $s["image"],
                    "medsos" => [
                        "facebook" => $medsos[0] ?? "",
                        "instagram" => $medsos[1] ?? "",
                        "linkedin" => $medsos[2] ?? ""
                    ]
                ];
            }

            return $this->respond([
                "status" => "success",
                "message" => "Successfully Get All Staff",
                "data" => $staff
            ]);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ]);
        }
    }

    public function show($id = null)
    {
        $staffArr = $this->model->find($id);

        if (!$staffArr) {
            return $this->respond([
                "status" => "failed",
                "message" => "Staff with NIP $id Not Found"
            ], 404);
        }

        $staff = [];
        $medsos = explode(";", $staffArr["medsos"]);
        $staff = [
            "nip" => $staffArr["nip"],
            "email" => $staffArr["email"],
            "name" => $staffArr["name"],
            "role" => $staffArr["role"],
            "image" => $staffArr["image"],
            "medsos" => [
                "facebook" => $medsos[0] ?? "",
                "instagram" => $medsos[1] ?? "",
                "linkedin" => $medsos[2] ?? ""
            ]
        ];

        if (!$staff) {
            return $this->respond([
                "status" => "failed",
                "message" => "Staff with NIP $id Not Found"
            ], 404);
        }
        return $this->respond([
            "status" => "success",
            "message" => "Get Staff by NIP Successfully",
            "data" => $staff
        ], status: 200);
    }

    public function create()
    {
        $jsonData = $this->request->getPost("data");
        $image = $this->request->getFile("image");
        $data = json_decode($jsonData, true);

        try {
            if ($image) {
                // Validasi dulu
                if (!$image->isValid()) {
                    return $this->fail('File tidak valid', 400);
                }

                // Pastikan yang diupload gambar
                $validationRule = [
                    'image' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
                    ],
                ];

                if (!$this->validate($validationRule)) {
                    return $this->fail($this->validator->getErrors());
                }

                // Rename biar unik
                $newName = $image->getRandomName();

                // Pindahkan ke folder writable/uploads
                $image->move(FCPATH . 'uploads', $newName);

                // Path file (kalau mau tampil di frontend)
                $fileUrl = base_url('uploads/' . $newName);

                $data["image"] = $fileUrl;
            }

            $this->model->insert($data);
            return $this->respond([
                "status" => "success",
                "message" => "Create Staff Data Successfully",
                "data" => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    public function update($id = null)
    {
        $jsonData = $this->request->getPost("data");
        $image = $this->request->getFile("image");
        $data = json_decode($jsonData, true);
        $checkId = $this->model->find($id);

        if (!$checkId) {
            return $this->respond([
                "status" => "failed",
                "message" => "NIP Not Found"
            ], 400);
        }

        try {
            if ($image) {
                // Validasi dulu
                if (!$image->isValid()) {
                    return $this->fail('File tidak valid', 400);
                }

                // Pastikan yang diupload gambar
                $validationRule = [
                    'image' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
                    ],
                ];

                if (!$this->validate($validationRule)) {
                    return $this->fail($this->validator->getErrors());
                }

                // Rename biar unik
                $newName = $image->getRandomName();

                // Pindahkan ke folder writable/uploads
                $image->move(FCPATH . 'uploads', $newName);

                // Path file (kalau mau tampil di frontend)
                $fileUrl = base_url('uploads/' . $newName);

                $data["image"] = $fileUrl;
            }

            $this->model->update($id, $data);
            return $this->respond([
                'status' => 'success',
                "message" => "Update Staff successfully",
                'data' => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    public function delete($id = null)
    {
        $checkId = $this->model->find($id);

        if (!$checkId) {
            return $this->respond([
                "status" => "failed",
                "message" => "NIP Not Found"
            ], 400);
        }

        try {
            $this->model->delete($id);
            return $this->respondDeleted([
                'status' => 'success',
                "message" => "Delete Staff successfully",
                'id' => $id
            ], 204);
        } catch (Exception $error) {
            return $this->respondDeleted([
                'status' => 'failed',
                "message" => $error->getMessage(),
            ], 400);
        }
    }
}
