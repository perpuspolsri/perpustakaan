<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\LandingPageContentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class LandingPageContentController extends ResourceController
{

    protected $modelName = LandingPageContentModel::class;
    protected $format    = 'json';

    public function index()
    {
        try {
            $content = $this->model->findAll();
            return $this->respond([
                "status" => "success",
                "message" => "Successfully Get Landing Page Content",
                "data" => $content
            ]);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage()
            ]);
        }
    }

    public function findAllLayanan()
    {
        try {
            $content = $this->model->select("landing_page_content_id")->like("landing_page_content_id", "layanan")->findAll();
            return $this->respond([
                "status" => "success",
                "message" => "Successfully Get Landing Page Content",
                "data" => $content
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
        $data = $this->model->find($id);
        if (!$data) {
            return $this->respond([
                "status" => "failed",
                "message" => "Content with id $id Not Found"
            ], 404);
        }
        return $this->respond([
            "status" => "success",
            "message" => "Get Content by ID Successfully",
            "data" => $data
        ], status: 200);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        $rules = [
            'landing_page_content_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond([
                "status" => "failed",
                "message" => $this->validator->getErrors()
            ], 400);
        }

        try {
            $this->model->insert($data);
            return $this->respond([
                "status" => "success",
                "message" => "Create Content Data Successfully",
                "data" => $data
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    public function createSlideShow()
    {
        $image = $this->request->getFile("image");

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
                $image->move(FCPATH . 'uploads/slideshow', $newName);

                // Path file (kalau mau tampil di frontend)
                $fileUrl = base_url('uploads/slideshow/' . $newName);
            }

            return $this->respond([
                "status" => "success",
                "message" => "Create Slide Show Image Successfully",
                "data" => $fileUrl
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }
    public function createFasilitas()
    {
        $image = $this->request->getFile("image");

        $fileUrl = "";
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
                $image->move(FCPATH . 'uploads/fasilitas', $newName);

                // Path file (kalau mau tampil di frontend)
                $fileUrl = base_url('uploads/fasilitas/' . $newName);
            }

            return $this->respond([
                "status" => "success",
                "message" => "Create Fasilitas Image Successfully",
                "data" => $fileUrl
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "status" => "failed",
                "message" => $error->getMessage(),
            ], 400);
        }
    }

    public function createEresource()
    {
        $image = $this->request->getFile("image");

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
                        'rules' => 'uploaded[image]|is_image[image]|max_size[image,2048]',
                    ],
                ];


                if (!$this->validate($validationRule)) {
                    return $this->fail($this->validator->getErrors());
                }

                // Rename biar unik
                $newName = $image->getRandomName();

                // Pindahkan ke folder writable/uploads
                $image->move(FCPATH . 'uploads/eresource', $newName);

                // Path file (kalau mau tampil di frontend)
                $fileUrl = base_url('uploads/eresource/' . $newName);
            }

            return $this->respond([
                "status" => "success",
                "message" => "Create E Resource Image Successfully",
                "data" => $fileUrl
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
        $data = $this->request->getJSON(true);

        try {
            // 1. Hapus file lama di server jika ada
            if (isset($data['delete']) && is_array($data['delete'])) {
                foreach ($data['delete'] as $oldFileUrl) {
                    // Ambil nama file dari URL
                    $fileName = basename($oldFileUrl);
                    $filePath = FCPATH . 'uploads/slideshow/' . $fileName;

                    if (is_file($filePath)) {
                        unlink($filePath); // hapus file
                    }
                }
            }

            // 2. Update content di DB
            if (isset($data['content'])) {
                $this->model->update($id, ['content' => $data['content']]);
            }

            return $this->respond([
                'status' => 'success',
                'message' => "Update Content successfully",
                'data' => $data
            ], 200);
        } catch (Exception $error) {
            return $this->respond([
                'status' => 'failed',
                'message' => $error->getMessage(),
            ], 400);
        }
    }


    public function delete($id = null)
    {
        try {
            $this->model->delete($id);
            return $this->respondDeleted([
                'status' => 'success',
                "message" => "Delete Content successfully",
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
