<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <?php if (isset($css)) : ?>
        <link rel="stylesheet" href="<?= base_url('css/loan.css') ?>">
    <?php endif; ?>
</head>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    gabarito: ['Gabarito', 'sans-serif'],
                },
                colors: {
                    "base-blue": "#16476A",
                    "t-gray": "#505050",
                    "base-hover": "#033554ff",
                    "b-green": "#009358",
                    "b-green-hover": "#037748ff",
                }
            },
        },
    }
</script>

<body class="font-gabarito text-t-gray">
    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('js/apiHelper.js'); ?>"></script>
</body>

</html>
