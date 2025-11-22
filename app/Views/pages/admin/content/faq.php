<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>
<div class="w-full mx-auto text-[#505050]">
    <div class="w-full flex items-center justify-between gap-2">
        <div class="flex items-center gap-2">
            <a href="/admin/content-management">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="#707070" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </a>
            <h1 class="text-3xl font-semibold">FAQ</h1>
        </div>
        <button id="faq-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit</span>
        </button>
    </div>
    <?= $this->include("layouts/loading") ?>
    <div class="w-full flex flex-col gap-2 mt-5 hidden" id="faq-area">
    </div>

    <!-- Modal -->
    <div id="faq-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit FAQ</h2>
                <button id="faq-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="faq-form" enctype="multipart/form-data">
                <button type="button" id="add-more-input" class="px-4 py-2 bg-base-blue rounded-md text-white hover:bg-base-hover transition-colors duration-200">
                    Tambah FAQ
                </button>
                <div class="mt-3 flex flex-col gap-2 overflow-y-auto max-h-80" id="form-area">
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="faq-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="faq-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let inputCount = 0;
    let globalfaqName = [];
    let globalfaqLink = [];

    const faqArea = document.getElementById("faq-area")
    const loading = document.getElementById("loading")
    const faqModal = document.getElementById("faq-modal")
    const faqModalButton = document.getElementById("faq-modal-button")
    const faqModalButtonClose = document.getElementById("faq-modal-button-close")
    const faqModalButtonBack = document.getElementById("faq-modal-button-back")
    const faqModalButtonSave = document.getElementById("faq-modal-button-save")
    const formArea = document.getElementById("form-area")
    const addMoreInput = document.getElementById("add-more-input")

    addMoreInput.addEventListener("click", function() {
        inputCount += 1;
        formArea.innerHTML += `<div class="flex flex-col gap-2">
                            <label for="body-faq" class="block text-sm font-medium text-t-gray">FAQ Ke-${inputCount}</label>
                            <input type="text" name="landing_page_content_id" id="question-${inputCount}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"/>
                            <textarea name="landing_page_content_id" id="answer-${inputCount}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" rows="5"></textarea>
                        </div>`
    })

    faqModalButton.addEventListener("click", async function() {
        faqModal.classList.remove('hidden');

        for (let i = 1; i <= inputCount; i++) {
            formArea.innerHTML += `<div class="flex flex-col gap-2">
                            <label for="body-faq" class="block text-sm font-medium text-t-gray">FAQ Ke-${i}</label>
                                <input type="text" value="${globalfaqName[i - 1]}" name="landing_page_content_id" id="question-${i}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <textarea name="landing_page_content_id" id="answer-${i}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" rows="5">${globalfaqName[i - 1]}</textarea>
                            </div>`
        }
    })

    faqModalButtonClose.addEventListener("click", function() {
        faqModal.classList.add('hidden');
    })

    faqModalButtonBack.addEventListener("click", function() {
        faqModal.classList.add('hidden');
    })

    faqModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault();

        // 1. Ambil data lama dari server
        let oldContent = await getfaqData(); // "url1;url2;url3;..."
        let oldImages = oldContent ? oldContent.split(";") : [];

        const fileInputs = [];

        for (let i = 1; i <= inputCount; i++) {
            fileInputs.push(document.getElementById(`image-${i}`))
        }

        let toDelete = []; // array URL yang akan dihapus

        for (let i = 0; i < fileInputs.length; i++) {
            let question = document.getElementById(`question-${i + 1}`).value
            let answer = document.getElementById(`answer-${i + 1}`).value
            oldImages[i] = oldImages[i] + "&" + question + "|" + answer || "";
        }

        const newContent = oldImages.join(";");

        try {
            // kirim ke backend: content baru + URL lama yang harus dihapus
            const response = await Api.post('/api/admin/contents/faq', {
                content: newContent,
                delete: toDelete
            });

            const result = response;
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'FAQ berhasil diperbarui ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/admin/content-management/faq';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui FAQ ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (err) {
            console.error(err);
            alert("Gagal memperbarui FAQ, coba lagi.");
        }
    });

    async function getfaqData() {
        try {
            const response = await Api.get('/api/public/contents/faq');
            const datas = response.data;
            if (datas) {
                loading.classList.add("hidden")
                faqArea.classList.remove("hidden")
            }
            return datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }


    document.addEventListener('DOMContentLoaded', async function() {
        const contents = await getfaqData();
        console.log(contents)
        let arrContents = contents.split(";");
        inputCount = arrContents.length
        console.log(inputCount)

        let prevQuestion = [];
        let prevAnswer = [];

        for (let i = 1; i <= inputCount; i++) {
            faqArea.innerHTML += `<div class="border rounded-lg overflow-hidden">
            <button
                class="w-full flex justify-between items-center bg-gray-100 px-4 py-3 font-medium hover:bg-gray-200"
                onclick="toggleFaq(this)" data-aos="slide-up">
                <span id="prev-question-${i}"></span>
                <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 bg-white">
                <p class="px-4 py-3 text-gray-600" id="prev-answer-${i}">
                </p>
            </div>
        </div>`

            prevQuestion.push(`prev-question-${i}`)
            prevAnswer.push(`prev-answer-${i}`)
        }

        let i = 0
        while (i <= prevQuestion.length) {
            let arrContentsSliced = arrContents[i].split("&")
            let arrContentName = arrContentsSliced[arrContentsSliced.length - 1]
            let arrContentLink = arrContentName.split("|")
            globalfaqName.push(arrContentLink[0])
            globalfaqLink.push(arrContentLink[arrContentLink.length - 1])
            document.getElementById(prevQuestion[i]).innerHTML += arrContentLink[0]
            document.getElementById(prevAnswer[i]).innerHTML += arrContentLink[arrContentLink.length - 1]
            i++
        }
    });

    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector("svg");
        content.classList.toggle("max-h-0");
        content.classList.toggle("max-h-40");
        icon.classList.toggle("rotate-180");
    }
</script>

<?= $this->endSection(); ?>
