<div class="px-4 md:px-20 pt-40 w-full flex flex-col gap-4">
    <div class="w-full">
        <h2 class="text-[var(--primary)] text-xl font-bold text-center">E-Resource</h2>
        <div class="flex flex-wrap justify-center gap-3 mt-3">
            <?php
            $eresourceArr = explode(";", $eresource[0]["content"]);
            $i = 1;
            foreach ($eresourceArr as $item) {
                $itemArr = explode("&", $item);
                $detailArr = explode("|", $itemArr[count($itemArr) - 1]);
                if (count($fasilitas) == $i) {
                    $i = 1;
                }
            ?>
                <a href="<?= $detailArr[count($detailArr) - 1] ?>" class="h-[80px] w-[45%] md:w-[18%]">
                    <div class="w-full h-full border border-gray-300 p-3 flex justify-center items-center rounded-md" data-aos="fade-up" data-aos-duration="800">
                        <img src="<?= $itemArr[0] ?>" alt="" class="w-full">
                    </div>
                </a>
            <?php $i++;
            } ?>
        </div>
    </div>
</div>
