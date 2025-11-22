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
            <h1 class="text-3xl font-semibold">Sejarah</h1>
        </div>
        <button id="sejarah-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit</span>
        </button>
    </div>
    <?= $this->include("layouts/loading") ?>
    <div class="mt-5 border border-gray-200 rounded-md p-6 text-sm leading-relaxed text-[#909090] hidden" id="sejarah-area">

    </div>

    <!-- Modal -->
    <div id="sejarah-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 overflow-y-auto h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit Sejarah</h2>
                <button id="sejarah-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="visionForm">
                <div>
                    <label for="bodySejarah" class="block text-sm font-medium text-t-gray mb-2">Isi Berita</label>
                    <div id="editor-container h-100">
                        <textarea id="bodySejarah" class="hidden ck-editor__editable" rows="3" id="sejarah-modal-content"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="sejarah-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="sejarah-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let sejarahEditor;
    ClassicEditor
        .create(document.querySelector('#bodySejarah'), {
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
            sejarahEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Deklarasi Components
    const loading = document.getElementById("loading")
    const sejarahArea = document.getElementById("sejarah-area")
    const sejarahModal = document.getElementById("sejarah-modal")
    const sejarahModalButton = document.getElementById("sejarah-modal-button")
    const sejarahModalButtonClose = document.getElementById("sejarah-modal-button-close")
    const sejarahModalButtonBack = document.getElementById("sejarah-modal-button-back")
    const sejarahModalButtonSave = document.getElementById("sejarah-modal-button-save")

    sejarahModalButton.addEventListener("click", function() {
        sejarahModal.classList.remove('hidden');
    })

    sejarahModalButtonClose.addEventListener("click", function() {
        sejarahModal.classList.add('hidden');
    })

    sejarahModalButtonBack.addEventListener("click", function() {
        sejarahModal.classList.add('hidden');
    })

    sejarahModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents/sejarah', {
            content: sejarahEditor.getData()
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Sejarah berhasil diperbarui ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management/sejarah';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui Sejarah ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    async function getsejarahData() {
        try {
            const response = await Api.get('/api/public/contents/sejarah');
            const datas = response.data;

            if (datas) {
                loading.classList.add("hidden")
                sejarahArea.classList.remove("hidden")
            }

            sejarahArea.innerHTML += datas.content
            sejarahEditor.setData(datas.content || "")
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        getsejarahData();
    });

    function savesejarah() {

    }
</script>

<?= $this->endSection(); ?>
