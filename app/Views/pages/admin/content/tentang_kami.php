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
            <h1 class="text-3xl font-semibold">Tentang Kami</h1>
        </div>
        <button id="tentang-kami-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit</span>
        </button>
    </div>
    <?= $this->include("layouts/loading") ?>
    <div class="mt-5 border border-gray-200 rounded-md p-6 text-sm leading-relaxed text-[#909090] hidden" id="tentang-kami-area">
    </div>

    <!-- Modal -->
    <div id="tentang-kami-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 overflow-y-auto h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit Tentang Kami</h2>
                <button id="tentang-kami-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="visionForm">
                <div>
                    <label for="body-tentang-kami" class="block text-sm font-medium text-t-gray mb-2">Isi Berita</label>
                    <div id="editor-container h-100">
                        <textarea id="body-tentang-kami" class="hidden" rows="3" id="tentang-kami-modal-content"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="tentang-kami-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="tentang-kami-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let tentangKamiEditor;
    ClassicEditor
        .create(document.querySelector('#body-tentang-kami'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo'
                ]
            },
            language: 'id',
            licenseKey: '',
        })
        .then(editor => {
            tentangKamiEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Deklarasi Components
    const loading = document.getElementById("loading")
    const tentangKamiArea = document.getElementById("tentang-kami-area")
    const tentangKamiModal = document.getElementById("tentang-kami-modal")
    const tentangKamiModalButton = document.getElementById("tentang-kami-modal-button")
    const tentangKamiModalButtonClose = document.getElementById("tentang-kami-modal-button-close")
    const tentangKamiModalButtonBack = document.getElementById("tentang-kami-modal-button-back")
    const tentangKamiModalButtonSave = document.getElementById("tentang-kami-modal-button-save")

    tentangKamiModalButton.addEventListener("click", function() {
        tentangKamiModal.classList.remove('hidden');
    })

    tentangKamiModalButtonClose.addEventListener("click", function() {
        tentangKamiModal.classList.add('hidden');
    })

    tentangKamiModalButtonBack.addEventListener("click", function() {
        tentangKamiModal.classList.add('hidden');
    })

    tentangKamiModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents/tentang_kami', {
            content: tentangKamiEditor.getData()
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Tentang Kami berhasil diperbarui ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management/tentang-kami';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui Tentang Kami ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    async function getTentangKamiData() {
        try {
            const response = await Api.get('/api/public/contents/tentang_kami');
            const datas = response.data;

            if (datas) {
                loading.classList.add("hidden")
                tentangKamiArea.classList.remove("hidden")
            }

            tentangKamiArea.innerHTML += datas.content
            tentangKamiEditor.setData(datas.content || "")
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        getTentangKamiData();
    });

    function saveTentangKami() {

    }
</script>

<?= $this->endSection(); ?>
