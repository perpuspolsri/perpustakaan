<?php

namespace App\Controllers;

use App\Models\LandingPageContentModel;

class Home extends BaseController
{
    public function index(): string
    {
        if(getenv("MAINTENANCE") == "true") {
            return view('maintenance');
        }
        
        $layananModel = new LandingPageContentModel();
        $layanan = $layananModel->select("landing_page_content_id")->like("landing_page_content_id", "layanan")->findAll();

        $fasilitasModel = new LandingPageContentModel();
        $fasilitas = $fasilitasModel->select("content")->where("landing_page_content_id", "fasilitas_content")->findAll();

        $eresourceModel = new LandingPageContentModel();
        $eresource = $eresourceModel->select("content")->where("landing_page_content_id", "eresource_content")->findAll();

        $faqModel = new LandingPageContentModel();
        $faq = $faqModel->select("content")->where("landing_page_content_id", "faq")->findAll();

        $data = [
            'title' => 'UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
            'layanan' => $layanan,
            'fasilitas' => $fasilitas,
            'eresource' => $eresource,
            'faq' => $faq,
        ];
        
        return view('pages/public/landing_page', $data);
    }

    public function test(): string
        {
            $layananModel = new LandingPageContentModel();
            $layanan = $layananModel->select("landing_page_content_id")->like("landing_page_content_id", "layanan")->findAll();
    
            $fasilitasModel = new LandingPageContentModel();
            $fasilitas = $fasilitasModel->select("content")->where("landing_page_content_id", "fasilitas_content")->findAll();
    
            $eresourceModel = new LandingPageContentModel();
            $eresource = $eresourceModel->select("content")->where("landing_page_content_id", "eresource_content")->findAll();
    
            $faqModel = new LandingPageContentModel();
            $faq = $faqModel->select("content")->where("landing_page_content_id", "faq")->findAll();
    
            $data = [
                'title' => 'UPT Perpustakaan Politeknik Negeri Sriwijaya',
                'role' => 'public',
                'layanan' => $layanan,
                'fasilitas' => $fasilitas,
                'eresource' => $eresource,
                'faq' => $faq,
            ];
            return view('pages/public/landing_page', $data);
        }

    public function about(): string
    {
        $data = [
            'title' => 'Tentang Kami - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/about', $data);
    }

    public function news(): string
    {
        $data = [
            'title' => 'Berita - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/news', $data);
    }

    public function newsDetail($path): string
    {
        $data = [
            'title' => 'Berita - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
            'path' => $path
        ];
        return view('pages/public/news-detail', $data);
    }

    public function layanan($layananPath): string
    {
        function formatPathToTitle($path)
        {
            $segments = explode('/', $path);
            $formatted = array_map(function ($segment) {
                $words = explode('-', $segment);
                $words = array_map(function ($word) {
                    return ucfirst($word);
                }, $words);
                return implode(' ', $words);
            }, $segments);
            return implode(' / ', $formatted);
        }

        function pathToUnderscore($path)
        {
            return str_replace('-', '_', $path);
        }

        $layanan = formatPathToTitle($layananPath);
        $layananEndpoint = pathToUnderscore($layananPath);
        $data = [
            'title' => 'UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
            'layanan_path' => $layananPath,
            'layanan' => $layanan,
            'layanan_endpoint' => $layananEndpoint
        ];
        return view('pages/public/layanan', $data);
    }

    public function circulationServices(): string
    {
        $data = [
            'title' => 'UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/circulation_services', $data);
    }

    public function memberServices(): string
    {
        $data = [
            'title' => 'Layanan Keanggotaan - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/member_services', $data);
    }

    public function pustakaServices(): string
    {
        $data = [
            'title' => 'Layanan Pustaka - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/pustaka_services', $data);
    }

    public function magangServices(): string
    {
        $data = [
            'title' => 'Layanan Magang - UPT Perpustakaan Politeknik Negeri Sriwijaya',
            'role' => 'public',
        ];
        return view('pages/public/magang_services', $data);
    }
}
