<?php

function formatPathToTitle($path)
{
    $segments = explode('/', $path);
    $formatted = array_map(function ($segment) {
        $words = explode('_', $segment);
        $words = array_map(function ($word) {
            return ucfirst($word);
        }, $words);
        return implode(' ', $words);
    }, $segments);
    return implode(' / ', $formatted);
}

function pathToDash($path)
{
    return str_replace('_', '-', $path);
}

function underscoreToCamelCase($string)
{
    // ubah semua ke huruf kecil biar konsisten
    $string = strtolower($string);

    // pisah berdasarkan underscore
    $parts = explode('_', $string);

    // huruf pertama tiap bagian (kecuali yang pertama) jadi kapital
    $camelCased = array_shift($parts);
    foreach ($parts as $part) {
        $camelCased .= ucfirst($part);
    }

    return $camelCased;
}

?>

<div class="px-4 md:px-20 pt-40 w-full flex flex-col gap-4">
    <div class="w-full">
        <h2 class="text-[var(--primary)] text-xl font-bold text-center">Informasi Layanan</h2>
        <p class="text-center">Layanan-layanan yang kami berikan</p>
    </div>
    <div class="flex md:flex-row justify-center items-center gap-5 h-1/2 md:h-96 flex-wrap">
        <?php
        $i = 1;
        foreach ($layanan as $item) {
            if (count($layanan) == $i) {
                $i = 1;
            }
        ?>
            <div class="border border-gray-300 w-full md:w-[20%] flex flex-col rounded-md" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                <div class="bg-[url('/img/layanan-background-<?= $i ?>.jpg')] bg-cover bg-center w-full h-40 md:h-64 rounded-t"></div>
                <div class="p-3 flex flex-col gap-2">
                    <div>
                        <p class="font-semibold"><?= formatPathToTitle($item["landing_page_content_id"]) ?></p>
                    </div>
                    <a href="/layanan/<?= pathToDash($item["landing_page_content_id"]) ?>" id="highlight-link">
                        <button
                            class="bg-[var(--primary)] py-1.5 px-4 flex justify-center items-center gap-2 text-white rounded text-center w-full transition-all duration-300 ease-in-out hover:px-5">
                            <img src="img/icons/book-light.svg" alt="">
                            Selengkapnya
                        </button>
                    </a>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>
</div>
