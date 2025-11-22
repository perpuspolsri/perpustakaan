<?php

namespace App\Controllers\Pages;

use App\Controllers\BaseController;
use App\Models\LandingPageContentModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function finesManagement()
    {
        $data = [
            'title' => 'UPT Perpustakaan - Fines Management',
            'role' => 'admin',
            'css' => 'admin_fines_management.css'
        ];
        return view('pages/admin/fines_management', $data);
    }

    public function newsManagement()
    {
        $data = [
            'title' => 'UPT Perpustakaan - News Management',
            'role' => 'admin',
            'css' => 'news_management.css'
        ];
        return view('pages/admin/news_management', $data);
    }

    public function reminder()
    {
        $data = [
            'title' => 'UPT Perpustakaan - H-1 Reminder',
            'role' => 'admin',
            'css' => 'admin_fines_management.css'
        ];
        return view('pages/admin/reminder', $data);
    }
    public function contentManagement()
    {
        $layananModel = new LandingPageContentModel();
        $layanan = $layananModel->select("landing_page_content_id")->like("landing_page_content_id", "layanan")->findAll();
        $data = [
            'title' => 'UPT Perpustakaan - Content Management',
            'role' => 'admin',
            'layanan' => $layanan
        ];
        return view('pages/admin/content_management', $data);
    }

    public function contentManagementDynamic($content)
    {
        function pathToUnderscore($path)
        {
            return str_replace('-', '_', $path);
        }

        $contentSliced = explode("-", $content);

        $layananModel = new LandingPageContentModel();
        if ($contentSliced[0] == "layanan") {
            $file = "layanan";
            $layanan = $layananModel->select("landing_page_content_id")->where("landing_page_content_id", pathToUnderscore($content))->findAll();
        } else {
            $file = pathToUnderscore($content);
            $layanan = $layananModel->select("landing_page_content_id")->like("landing_page_content_id", "layanan")->findAll();
        }

        $data = [
            'title' => 'UPT Perpustakaan - Content Management',
            'role' => 'admin',
            'layanan' => $layanan,
            'file' => $file
        ];
        return view("pages/admin/content/$file", $data);
    }

    public function addNewsManagement()
    {
        $data = [
            'title' => 'UPT Perpustakaan - Create News Management',
            'role' => 'admin',
        ];
        return view('pages/admin/add_news_management', $data);
    }

    public function WAServiceMonitoring()
    {
        $data = [
            'title' => 'UPT Perpustakaan - WA Service Monitoring',
            'role' => 'admin',
        ];
        return view('pages/admin/wa_service_monitoring', $data);
    }

    public function kritikSaran()
    {
        $data = [
            'title' => 'UPT Perpustakaan - Kritik & Saran',
            'role' => 'admin',
        ];
        return view('pages/admin/kritik_saran', $data);
    }

    public function peminjamanMandiriIP()
    {
        $data = [
            'title' => 'UPT Perpustakaan - Kritik & Saran',
            'role' => 'admin',
        ];
        return view('pages/admin/peminjaman_mandiri_ip', $data);
    }
}
