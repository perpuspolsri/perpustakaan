<section class="bg-white border border-gray-200 rounded-lg p-7 shadow-sm">
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-bold text-[#505050]"><?= esc($layanan_title) ?></h2>
        <div class="flex justify-center items-center gap-2">
            <button id="<?= esc($dash) ?>-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Edit</span>
            </button>
            <button id="<?= esc($dash) ?>-modal-button-delete" class="bg-red-800 hover:bg-red-700 text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 7H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6 10L7.70141 19.3578C7.87432 20.3088 8.70258 21 9.66915 21H14.3308C15.2974 21 16.1257 20.3087 16.2986 19.3578L18 10" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
                <span>Delete</span>
            </button>
        </div>
    </div>
    <div class="border border-gray-200 rounded-md p-6 text-sm leading-relaxed overflow-y-auto max-h-80 text-[#909090]" id="<?= esc($dash) ?>-area">

    </div>
</section>

<div id="<?= esc($dash) ?>-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-[#505050]">Edit <?= esc($layanan_title) ?></h2>
            <button id="<?= esc($dash) ?>-modal-button-close" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="visionForm">
            <div>
                <label for="body<?= esc($camel) ?>" class="block text-sm font-medium text-t-gray mb-2">Isi Berita</label>
                <div id="editor-container h-100">
                    <textarea id="body<?= esc($camel) ?>" class="hidden" rows="3" id="<?= esc($dash) ?>-modal-content"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-3">
                <button type="button" id="<?= esc($dash) ?>-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </button>
                <button id="<?= esc($dash) ?>-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let <?= esc($camel) ?>Editor;
    ClassicEditor
        .create(document.querySelector('#body<?= esc($camel) ?>'), {
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
            <?= esc($camel) ?>Editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Deklarasi Components
    const <?= esc($camel) ?>Area = document.getElementById("<?= esc($dash) ?>-area")
    const <?= esc($camel) ?>Modal = document.getElementById("<?= esc($dash) ?>-modal")
    const <?= esc($camel) ?>ModalButton = document.getElementById("<?= esc($dash) ?>-modal-button")
    const <?= esc($camel) ?>ModalButtonDelete = document.getElementById("<?= esc($dash) ?>-modal-button-delete")
    const <?= esc($camel) ?>ModalButtonClose = document.getElementById("<?= esc($dash) ?>-modal-button-close")
    const <?= esc($camel) ?>ModalButtonBack = document.getElementById("<?= esc($dash) ?>-modal-button-back")
    const <?= esc($camel) ?>ModalButtonSave = document.getElementById("<?= esc($dash) ?>-modal-button-save")

    <?= esc($camel) ?>ModalButton.addEventListener("click", function() {
        <?= esc($camel) ?>Modal.classList.remove('hidden');
    })

    <?= esc($camel) ?>ModalButtonClose.addEventListener("click", function() {
        <?= esc($camel) ?>Modal.classList.add('hidden');
    })

    <?= esc($camel) ?>ModalButtonBack.addEventListener("click", function() {
        <?= esc($camel) ?>Modal.classList.add('hidden');
    })

    <?= esc($camel) ?>ModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.patch('/api/admin/contents/<?= esc($underscore) ?>', {
            content: <?= esc($camel) ?>Editor.getData()
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc($layanan_title) ?> berhasil diperbarui ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui <?= esc($layanan_title) ?> ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    <?= esc($camel) ?>ModalButtonDelete.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.del('/api/admin/contents/<?= esc($underscore) ?>');

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc($layanan_title) ?> berhasil dihapus ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menghapus <?= esc($layanan_title) ?> ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    async function get<?= esc($camel) ?>Data() {
        try {
            const response = await Api.get('/api/public/contents/<?= esc($underscore) ?>');
            const datas = response.data;

            <?= esc($camel) ?>Area.innerHTML += datas.content
            <?= esc($camel) ?>Editor.setData(datas.content || "")
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        get<?= esc($camel) ?>Data();
    });

    function save<?= esc($camel) ?>() {

    }
</script>
