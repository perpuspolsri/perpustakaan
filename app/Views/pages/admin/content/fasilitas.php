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
            <h1 class="text-3xl font-semibold">Fasilitas</h1>
        </div>
        <button id="fasilitas-modal-button" class="bg-base-blue hover:bg-base-hover text-white px-4 py-1.5 rounded-md flex items-center space-x-1 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit</span>
        </button>
    </div>
    <?= $this->include("layouts/loading") ?>
    <div class="mt-5 text-sm leading-relaxed text-[#909090] grid grid-cols-1 lg:grid-cols-3 gap-3 hidden" id="fasilitas-area">
    </div>

    <!-- Modal -->
    <div id="fasilitas-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-[#505050]">Edit Fasilitas</h2>
                <button id="fasilitas-modal-button-close" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="fasilitas-form" enctype="multipart/form-data">
                <button type="button" id="add-more-input" class="px-4 py-2 bg-base-blue rounded-md text-white hover:bg-base-hover transition-colors duration-200">
                    Tambah Gambar
                </button>
                <div class="mt-3 flex flex-col gap-2 overflow-y-auto max-h-80" id="form-area">
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button type="button" id="fasilitas-modal-button-back" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                        Batal
                    </button>
                    <button id="fasilitas-modal-button-save" type="submit" class="px-4 py-2 bg-b-green hover:bg-b-green-hover text-white rounded-md  transition-colors duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let inputCount = 0;
    let globalFasilitasName = [];

    const fasilitasArea = document.getElementById("fasilitas-area")
    const loading = document.getElementById("loading")
    const slideShowModal = document.getElementById("fasilitas-modal")
    const slideShowModalButton = document.getElementById("fasilitas-modal-button")
    const slideShowModalButtonClose = document.getElementById("fasilitas-modal-button-close")
    const slideShowModalButtonBack = document.getElementById("fasilitas-modal-button-back")
    const slideShowModalButtonSave = document.getElementById("fasilitas-modal-button-save")
    const formArea = document.getElementById("form-area")
    const addMoreInput = document.getElementById("add-more-input")

    addMoreInput.addEventListener("click", function() {
        inputCount += 1;
        formArea.innerHTML += `<div>
                            <label for="body-fasilitas" class="block text-sm font-medium text-t-gray">Gambar ${inputCount}</label>
                            <input type="file" name="landing_page_content_id" accept="image/*" id="image-${inputCount}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <input type="text" name="landing_page_content_id" id="image-name-${inputCount}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>`
    })

    slideShowModalButton.addEventListener("click", async function() {
        slideShowModal.classList.remove('hidden');

        for (let i = 1; i <= inputCount; i++) {
            formArea.innerHTML += `<div class="flex flex-col gap-2">
                            <label for="body-fasilitas" class="block text-sm font-medium text-t-gray">Gambar ${i}</label>
                            <input type="file" name="landing_page_content_id" accept="image/*" id="image-${i}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <input type="text" value="${globalFasilitasName[i - 1]}" name="landing_page_content_id" id="image-name-${i}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>`
        }
    })

    slideShowModalButtonClose.addEventListener("click", function() {
        slideShowModal.classList.add('hidden');
    })

    slideShowModalButtonBack.addEventListener("click", function() {
        slideShowModal.classList.add('hidden');
    })

    async function uploadImage($image) {
        const formData = new FormData();
        formData.append("image", $image)
        const token = localStorage.getItem('jwt_token');

        const res = await fetch("/api/admin/contents/fasilitas", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${token}`,
            },
            body: formData,
        });

        if (!res.ok) {
            console.log("err");
            return "";
        }

        const result = await res.json();
        return result.data; // return data aja
    }


    slideShowModalButtonSave.addEventListener("click", async function(e) {
        e.preventDefault();

        // 1. Ambil data lama dari server
        let oldContent = await getslideShowData(); // "url1;url2;url3;..."
        let oldImages = oldContent ? oldContent.split(";") : [];

        const fileInputs = [];

        for (let i = 1; i <= inputCount; i++) {
            fileInputs.push(document.getElementById(`image-${i}`))
        }

        let toDelete = []; // array URL yang akan dihapus

        for (let i = 0; i < fileInputs.length; i++) {
            const file = fileInputs[i].files[0];
            if (file) {
                // kalau ada file baru, tambahkan URL lama ke toDelete
                if (oldImages[i]) toDelete.push(oldImages[i]);

                // upload file baru
                const uploadedUrl = await uploadImage(file);
                oldImages[i] = uploadedUrl + "&" + document.getElementById(`image-name-${i + 1}`).value;

                // update preview image langsung
                const previewImg = document.getElementById(`prev-image-${i+1}`);
                if (previewImg) previewImg.src = uploadedUrl;
            } else {
                let imageName = document.getElementById(`image-name-${i + 1}`).value
                oldImages[i] = oldImages[i] + "&" + imageName || "";
            }
        }

        const newContent = oldImages.join(";");

        try {
            // kirim ke backend: content baru + URL lama yang harus dihapus
            const response = await Api.post('/api/admin/contents/fasilitas_content', {
                content: newContent,
                delete: toDelete
            });

            const result = response;
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Fasilitas berhasil diperbarui ✅',
                    confirmButtonText: 'OK',
                    timer: 2000,
                    willClose: () => {
                        window.location.href = '/admin/content-management/fasilitas';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal memperbarui Fasilitas ❌',
                    confirmButtonText: 'OK'
                });
            }
        } catch (err) {
            console.error(err);
            alert("Gagal memperbarui Fasilitas, coba lagi.");
        }
    });

    async function getslideShowData() {
        try {
            const response = await Api.get('/api/public/contents/fasilitas_content');
            const datas = response.data;
            if (datas) {
                loading.classList.add("hidden")
                fasilitasArea.classList.remove("hidden")
            }
            return datas.content
        } catch (error) {
            console.error('Error fetching fines:', error);
        }
    }


    document.addEventListener('DOMContentLoaded', async function() {
        const contents = await getslideShowData();
        console.log(contents)
        let arrContents = contents.split(";");
        inputCount = arrContents.length
        console.log(inputCount)

        let prevImages = [];
        let prevImagesName = [];

        for (let i = 1; i <= inputCount; i++) {
            fasilitasArea.innerHTML += ` <div class="relative">
            <p class="absolute bottom-1 left-1 text-white bg-base-blue px-2 h-6 flex justify-center items-center rounded" id="prev-image-name-${i}">${i}</p>
            <img src="" alt="" id="prev-image-${i}" class="w-full rounded">
        </div>`
            prevImages.push(`prev-image-${i}`)
            prevImagesName.push(`prev-image-name-${i}`)
        }

        let i = 0
        while (i <= prevImages.length) {
            let arrContentsSliced = arrContents[i].split("&")
            globalFasilitasName.push(arrContentsSliced[arrContentsSliced.length - 1])
            document.getElementById(prevImages[i]).src = arrContentsSliced[0]
            document.getElementById(prevImagesName[i]).innerHTML += ". " + arrContentsSliced[arrContentsSliced.length - 1]
            i++
        }
    });
</script>

<?= $this->endSection(); ?>
