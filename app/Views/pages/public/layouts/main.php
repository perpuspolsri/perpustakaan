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

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

    <style>
        :root {
            --primary: #16476A;
            /* biru tua */
            --secondary: #facc15;
            /* kuning */
            --overlay: rgba(0, 0, 0, 0.5);
        }

        strong {
            font-weight: bold !important;
        }

        .anim-scroll {
            animation: 3s scroll ease-in-out infinite;
        }

        table {
            border: 1px solid black;
        }

        td {
            padding: 10px;
            border: 1px solid black;
        }

        @keyframes scroll {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        gabarito: ['Gabarito', 'sans-serif'],
                    }
                },
            },
        }
    </script>
</head>

<body>
    <div class="font-gabarito font-thin flex flex-col items-center text-[#303030]">
        <?= $this->renderSection('content') ?>
    </div>
    </div>

    <script src="<?= base_url('js/apiHelper.js'); ?>"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // All elements will animate only once
        });
    </script>

    <?= $this->renderSection('scripts'); ?>
    <style>
        ol {
            list-style-type: lower-alpha;
            margin-left: 30px;
            /* Uses uppercase Roman numerals */
        }
    </style>
</body>

</html>
