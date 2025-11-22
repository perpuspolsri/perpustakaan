<?php

namespace App\Controllers\API\Services;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\MemberModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Exception;

class EmailController extends ResourceController
{
    protected $modelName = LoanModel::class;
    protected $format    = 'json';
    public function index()
    {
        $body = '
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
    .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e2e2e2; border-radius: 8px; background-color: #f9f9f9; }
    .header { text-align: center; margin-bottom: 20px; }
    .header h2 { color: #2c3e50; }
    .details { margin-bottom: 20px; }
    .details table { width: 100%; border-collapse: collapse; }
    .details th, .details td { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; }
    .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Pengingat Peminjaman Buku Politeknik Negeri Sriwijaya</h2>
    </div>

    <p>Halo <strong>{nama}</strong> (NPM: <strong>{npm}</strong>),</p>

    <p>Ini adalah pengingat bahwa Anda memiliki buku yang jatuh tempo di Perpustakaan Polsri:</p>

    <div class="details">
      <table>
        <tr>
          <th>Buku</th>
          <td>{judul_buku}</td>
        </tr>
        <tr>
          <th>Tanggal Jatuh Tempo</th>
          <td>{tanggal_jatuh_tempo} ({total_hari} hari)</td>
        </tr>
        <tr>
          <th>Total Denda</th>
          <td>Rp {total_denda}</td>
        </tr>
      </table>
    </div>

    <p>Mohon segera kembalikan buku tersebut untuk menghindari denda tambahan. Terima kasih telah memanfaatkan layanan perpustakaan kami.</p>

    <div class="footer">
      <p>Perpustakaan Politeknik Negeri Sriwijaya &copy; 2025</p>
    </div>
  </div>
</body>
</html>
';

        $bodyHmin = '
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
    .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e2e2e2; border-radius: 8px; background-color: #f9f9f9; }
    .header { text-align: center; margin-bottom: 20px; }
    .header h2 { color: #2c3e50; }
    .details { margin-bottom: 20px; }
    .details table { width: 100%; border-collapse: collapse; }
    .details th, .details td { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; }
    .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Pengingat Peminjaman Buku Politeknik Negeri Sriwijaya</h2>
    </div>

    <p>Halo <strong>{nama}</strong> (NPM: <strong>{npm}</strong>),</p>

    <p>Ini adalah pengingat bahwa Anda memiliki buku yang besok akan jatuh tempo di Perpustakaan Polsri:</p>

    <div class="details">
      <table>
        <tr>
          <th>Buku</th>
          <td>{judul_buku}</td>
        </tr>
        <tr>
          <th>Tanggal Jatuh Tempo</th>
          <td>{tanggal_jatuh_tempo}</td>
        </tr>
      </table>
    </div>

    <p>Mohon segera kembalikan buku tersebut untuk menghindari denda. Terima kasih telah memanfaatkan layanan perpustakaan kami.</p>

    <div class="footer">
      <p>Perpustakaan Politeknik Negeri Sriwijaya &copy; 2025</p>
    </div>
  </div>
</body>
</html>
';

        try {
            $fines = $this->model->getAllFines();
            $finesHmin = $this->model->getAllFinesHmin();

            if (empty($fines) && empty($finesHmin)) {
                return $this->respond([
                    "status" => "success",
                    "message" => "There is no overdues today"
                ]);
            }

            if (!empty($fines)) {
                foreach ($fines as $fine) {
                    $bodyMessage = str_replace(
                        ['{nama}', '{npm}', '{judul_buku}', '{tanggal_jatuh_tempo}', '{total_hari}', '{total_denda}'],
                        [$fine["member_name"], $fine["member_id"], $fine["title"], $fine["due_date"], $fine["days_total"], $fine["fine_total"]],
                        $body
                    );
                    $member_email = $fine["member_email"];
                    $email = Services::email();
                    $email->setTo($member_email);
                    $email->setFrom('hiddevlearn@gmail.com', 'UPT. Perpustakaan POLSRI');
                    $email->setSubject('Peringatan Jatuh Tempo');
                    $email->setMessage($bodyMessage);
                    $email->send();
                }
            }

            if (!empty($finesHmin)) {
                foreach ($finesHmin as $fine) {
                    $bodyMessage = str_replace(
                        ['{nama}', '{npm}', '{judul_buku}', '{tanggal_jatuh_tempo}'],
                        [$fine["member_name"], $fine["member_id"], $fine["title"], $fine["due_date"]],
                        $body
                    );
                    $member_email = $fine["member_email"];
                    $email = Services::email();
                    $email->setTo($member_email);
                    $email->setFrom('hiddevlearn@gmail.com', 'UPT. Perpustakaan POLSRI');
                    $email->setSubject('Peringatan H-1 Jatuh Tempo');
                    $email->setMessage($bodyMessage);
                    $email->send();
                }
            }

            return $this->respond([
                "status" => "success",
                "message" => "Successfully check for all h-1 and overdues"
            ], 201);
        } catch (Exception $error) {
            return $this->respond([
                "error" => $error->getMessage()
            ], 400);
        }
    }


    public function byLoanId($id)
    {
        $body = '
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.5; }
    .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #e2e2e2; border-radius: 8px; background-color: #f9f9f9; }
    .header { text-align: center; margin-bottom: 20px; }
    .header h2 { color: #2c3e50; }
    .details { margin-bottom: 20px; }
    .details table { width: 100%; border-collapse: collapse; }
    .details th, .details td { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; }
    .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Pengingat Peminjaman Buku Politeknik Negeri Sriwijaya</h2>
    </div>

    <p>Halo <strong>{nama}</strong> (NPM: <strong>{npm}</strong>),</p>

    <p>Ini adalah pengingat bahwa Anda memiliki buku yang jatuh tempo di Perpustakaan Polsri:</p>

    <div class="details">
      <table>
        <tr>
          <th>Buku</th>
          <td>{judul_buku}</td>
        </tr>
        <tr>
          <th>Tanggal Jatuh Tempo</th>
          <td>{tanggal_jatuh_tempo} ({total_hari} hari)</td>
        </tr>
        <tr>
          <th>Total Denda</th>
          <td>Rp {total_denda}</td>
        </tr>
      </table>
    </div>

    <p>Mohon segera kembalikan buku tersebut untuk menghindari denda tambahan. Terima kasih telah memanfaatkan layanan perpustakaan kami.</p>

    <div class="footer">
      <p>Perpustakaan Politeknik Negeri Sriwijaya &copy; 2025</p>
    </div>
  </div>
</body>
</html>
';

        try {
            $fine = $this->model->getFineById($id);
            $member_email = $fine["member_email"];

            $bodyMessage = str_replace(
                ['{nama}', '{npm}', '{judul_buku}', '{tanggal_jatuh_tempo}', '{total_hari}', '{total_denda}'],
                [$fine["member_name"], $fine["member_id"], $fine["title"], $fine["due_date"], $fine["days_total"], $fine["fine_total"]],
                $body
            );

            $email = Services::email();
            $email->setTo($member_email);
            $email->setFrom('hiddevlearn@gmail.com', 'UPT. Perpustakaan POLSRI');
            $email->setSubject('Peringatan Jatuh Tempo');
            $email->setMessage($bodyMessage);

            if ($email->send()) {
                return $this->respond([
                    "status" => "success",
                    "message" => "Successfully send email to $member_email"
                ], 201);
            } else {
                echo $email->printDebugger(['headers']);
            }
        } catch (Exception $error) {
            return $this->respond([
                "error" => $error->getMessage()
            ], 400);
        }
    }
}
