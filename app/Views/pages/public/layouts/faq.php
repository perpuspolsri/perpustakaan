<div class="px-8 md:px-20 pt-40 w-full flex flex-col items-center gap-4 font-gabarito">
    <div class="w-full md:w-4/5">
        <h2 class="text-[var(--primary)] text-xl font-bold">FAQ</h2>
        <p>Pertanyaan-pertanyaan yang sering diajukan</p>
    </div>
    <div class="w-full md:w-4/5 mx-auto space-y-3">
        <?php
        $faqArr = explode(";", $faq[0]["content"]);
        $i = 1;
        foreach ($faqArr as $item) {
            $itemArr = explode("&", $item);
            $detailArr = explode("|", $itemArr[count($itemArr) - 1]);
            if (count($fasilitas) == $i) {
                $i = 1;
            }
        ?>
            <div class="border rounded-lg overflow-hidden">
                <button
                    class="w-full flex justify-between items-center bg-gray-100 px-4 py-3 font-medium hover:bg-gray-200"
                    onclick="toggleFaq(this)" data-aos="slide-up">
                    <span><?= $detailArr[0] ?></span>
                    <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 bg-white">
                    <p class="px-4 py-3 text-gray-600">
                        <?= $detailArr[1] ?>
                    </p>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>
</div>
<script>
    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector("svg");
        content.classList.toggle("max-h-0");
        content.classList.toggle("max-h-40");
        icon.classList.toggle("rotate-180");
    }
</script>
