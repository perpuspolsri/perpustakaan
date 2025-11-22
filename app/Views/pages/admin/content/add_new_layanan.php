<div id="add-new-layanan-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-[#505050]">Tambah Layanan Baru</h2>
            <button id="add-new-layanan-modal-button-close" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="visionForm">
            <div>
                <label for="bodyAddNewLayanan" class="block text-sm font-medium text-t-gray mb-2">Nama Layanan</label>
                <input type="text" name="landing_page_content_id" id="new-layanan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
            </div>
            <div class="flex justify-end space-x-3 mt-3">
                <button type="button" id="add-new-layanan-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                    Batal
                </button>
                <button id="add-new-layanan-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const addNewLayananModalButtonClose = document.getElementById("add-new-layanan-modal-button-close")
    const addNewLayananModalButtonBack = document.getElementById("add-new-layanan-modal-button-back")
    const addNewLayananModalButtonSave = document.getElementById("add-new-layanan-modal-button-save")
    const newLayanan = document.getElementById("new-layanan")

    addNewLayananModalButtonClose.addEventListener("click", function() {
        addNewLayananModal.classList.add('hidden');
    })

    addNewLayananModalButtonBack.addEventListener("click", function() {
        addNewLayananModal.classList.add('hidden');
    })

    function titleToUnderscore(title) {
        return title
            .toLowerCase() // jadi huruf kecil semua
            .replace(/\s+/g, '_'); // ganti spasi (atau multiple spasi) jadi underscore
    }

    addNewLayananModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault()
        const response = await Api.post('/api/admin/contents', {
            landing_page_content_id: titleToUnderscore(newLayanan.value)
        });

        const result = response;
        if (result.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Layanan Baru berhasil dibuat ✅',
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
                text: 'Gagal memperbarui Layanan Baru ❌',
                confirmButtonText: 'OK'
            });
        }
    })
</script>
