<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>

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
            <h1 class="text-3xl font-semibold"><?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?></h1>
        </div>
        <div class="flex gap-2">
            <button id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Edit</span>
            </button>
            <button id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-delete" class="bg-red-800 hover:bg-red-700 text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
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
    <?= $this->include("layouts/loading") ?>
    <div class="mt-5 border border-gray-200 rounded-md p-6 text-sm leading-relaxed text-[#909090] hidden" id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-area">

    </div>

    <!-- Modal -->
    <div id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 overflow-y-auto h-[90vh]">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit <?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?></h2>
                <button id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="visionForm">
                <div>
                    <label for="body<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>" class="block text-sm font-medium text-t-gray mb-2">Isi Berita</label>
                    <div id="editor-container h-100">
                        <textarea id="body<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>" class="hidden" rows="3" id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-content"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Editor;
    ClassicEditor
        .create(document.querySelector('#body<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>'), {
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
            <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Deklarasi Components
    const loading = document.getElementById("loading")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Area = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-area")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Modal = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButton = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonDelete = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-delete")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonClose = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-close")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonBack = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-back")
    const <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonSave = document.getElementById("<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>-modal-button-save")

    <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButton.addEventListener("click", function() {
        <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Modal.classList.remove('hidden');
    })

    <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonClose.addEventListener("click", function() {
        <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Modal.classList.add('hidden');
    })

    <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonBack.addEventListener("click", function() {
        <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Modal.classList.add('hidden');
    })

    <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents/<?= $layanan[0]["landing_page_content_id"] ?>', {
            content: <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Editor.getData()
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?> berhasil diperbarui ✅',
                confirmButtonText: 'OK',
                timer: 2000,
                willClose: () => {
                    window.location.href = '/admin/content-management/<?= pathToDash($layanan[0]["landing_page_content_id"]) ?>';
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui <?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?> ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>ModalButtonDelete.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents/delete/<?= $layanan[0]["landing_page_content_id"] ?>');

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?> berhasil dihapus ✅',
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
                text: 'Gagal menghapus <?= formatPathToTitle($layanan[0]["landing_page_content_id"]) ?> ❌',
                confirmButtonText: 'OK'
            });
        }
    })

    async function get<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Data() {
        try {
            const response = await Api.get('/api/public/contents/<?= $layanan[0]["landing_page_content_id"] ?>');
            const datas = response.data;

            if (datas) {
                loading.classList.add("hidden")
                <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Area.classList.remove("hidden")
            }

            <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Area.innerHTML += datas.content
            <?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Editor.setData(datas.content || "")
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        get<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>Data();
    });

    function save<?= underscoreToCamelCase($layanan[0]["landing_page_content_id"]) ?>() {

    }
</script>

<?= $this->endSection(); ?>
