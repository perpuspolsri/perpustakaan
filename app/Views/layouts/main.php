<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? "UPT Perpustakaan Politeknik Negeri Sriwijaya" ?></title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Text Editor -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/47.1.0/ckeditor5.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Custom -->
    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="<?= base_url('css/' . $css) ?>">
    <?php endif; ?>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        gabarito: ['Gabarito', 'sans-serif'],
                    },
                    colors:{
                        "base-blue" : "#16476A",
                        "hover-blue" : "#1f59d6",
                        "t-gray" : "#505050",
                        "base-hover" : "#033554ff",
                        "b-green" : "#009358",
                        "b-green-hover" : "#037748ff",
                    }

                }
            },
        }
    </script>
</head>

<body>
    <div class="font-gabarito">
        <div class="flex min-h-screen font-['gabarito']">
            <?php if ($role == 'admin') {
                echo $this->include('layouts/nav');
            } else if ($role === "public") {
                echo $this->include('layouts/nav_public');
            } else if($role === 'member') {
                echo $this->include('layouts/nav_user');
            }
            ?>

            <main class="<?php if($role != "") {echo "m-0 md:ml-72 h-fit";} else {echo "ml-0 h-screen";}?> flex flex-col p-10 w-full">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="<?= base_url('js/apiHelper.js'); ?>"></script>

    <?= $this->renderSection('scripts'); ?>
</body>

</html>
