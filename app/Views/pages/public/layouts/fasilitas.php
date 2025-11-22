<div class="px-8 md:px-20 pt-40 w-full flex flex-col gap-4">
    <div class="w-full">
        <h2 class="text-[var(--primary)] text-xl font-bold text-center">Fasilitas</h2>
        <p class="text-center">Fasilitas-Fasilitas Nyaman Yang Kami Sediakan</p>
    </div>
    <div class="flex flex-wrap justify-center gap-5">
        <?php
        $fasilitasArr = explode(";", $fasilitas[0]["content"]);
        $i = 1;
        foreach ($fasilitasArr as $item) {
            $itemArr = explode("&", $item);
            if (count($fasilitas) == $i) {
                $i = 1;
            }
        ?>
            <div class="relative h-[300px] w-[45%] md:w-[23%] hover:bg-bottom transition-all duration-300 ease-in-out bg-[url('<?= $itemArr[0] ?>')] bg-cover bg-center p-3 flex flex-col justify-end text-white gap-3 rounded" style="height: 300px;">
                <div class="relative z-10 flex flex-col" data-aos="fade-up" data-aos-duration="<?= $i * 100 ?>">
                    <h2 class="text-xl font-semibold"><?= $itemArr[count($itemArr) - 1] ?></h2>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>
</div>
