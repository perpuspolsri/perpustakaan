<?php
// maintenance.php
// Halaman Maintenance Mode

// Set header untuk content type
header('Content-Type: text/html; charset=utf-8');

// Waktu maintenance (opsional)
$maintenance_start = "16 Oktober 2025";
$maintenance_end = "TBA";
$contact_email = "wengdev@quantumelektra.com";

// Anda bisa menambahkan logika untuk menampilkan halaman maintenance
// hanya dalam kondisi tertentu, misalnya:
// if ($maintenance_mode === true) { ... }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Dalam Pengembangan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .maintenance-container {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            width: 90%;
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        h1 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 2.2rem;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }

        .info-box {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            margin: 2rem 0;
            text-align: left;
        }

        .info-item {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .info-item i {
            margin-right: 10px;
            color: #667eea;
        }

        .contact-info {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-top: 1rem;
        }

        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            margin: 2rem 0;
            overflow: hidden;
        }

        .progress {
            width: 75%;
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 3px;
            animation: progressAnimation 2s ease-in-out infinite;
        }

        @keyframes progressAnimation {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(400%); }
        }

        .social-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
        }

        @media (max-width: 480px) {
            .maintenance-container {
                padding: 2rem 1.5rem;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .icon {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="icon">🚧</div>
        
        <h1>Website POLSRI LIBRARY Sedang Dalam Pengembangan</h1>
        
        <p>Maaf untuk ketidaknyamanannya. Kami sedang melakukan pembaruan dan perbaikan untuk memberikan pengalaman yang lebih baik.</p>

        <div class="progress-bar">
            <div class="progress"></div>
        </div>

        <div class="info-box">
            <div class="info-item">
                <strong style="margin-right: 10px;">📅 Perkiraan Waktu Maintenance:</strong>
                <?php echo $maintenance_start; ?> - <?php echo $maintenance_end; ?>
            </div>
            <div class="info-item">
                <strong style="margin-right: 10px;">⏰ Status: </strong>Dalam Pengerjaan
            </div>
            <div class="info-item">
                <strong style="margin-right: 10px;">📊 Progress:</strong>Nan% Selesai
            </div>
            <div class="info-item">
                <strong style="margin-right: 10px;">💻 For Developer:</strong> <a href="<?= '/logout'; ?>">Klik link ini</a>
            </div>
        </div>

        <p>Kami berusaha untuk menyelesaikan maintenance secepat mungkin. Terima kasih atas pengertian dan kesabaran Anda.</p>

        <div class="contact-info">
            <p>Jika Anda membutuhkan bantuan segera, silakan hubungi:</p>
            <a href="mailto:<?php echo $contact_email; ?>" class="btn">
                📧 <?php echo $contact_email; ?>
            </a>
        </div>

        <div class="social-links">
            <a href="#" class="social-link" title="Facebook">📘</a>
            <a href="#" class="social-link" title="Twitter">🐦</a>
            <a href="#" class="social-link" title="Instagram">📷</a>
            <a href="#" class="social-link" title="LinkedIn">💼</a>
        </div>

        <div style="margin-top: 2rem; font-size: 0.9rem; color: #999;">
            &copy; <?php echo date('Y'); ?> Politeknik Negeri Sriwijaya. All rights reserved.
        </div>
    </div>

    <script>
        // Script sederhana untuk menampilkan waktu lokal
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const timeElement = document.createElement('div');
            timeElement.style.marginTop = '1rem';
            timeElement.style.color = '#666';
            timeElement.style.fontSize = '0.9rem';
            timeElement.innerHTML = '🕒 Waktu server: ' + now.toLocaleString('id-ID');
            document.querySelector('.maintenance-container').appendChild(timeElement);
        });
    </script>
</body>
</html>