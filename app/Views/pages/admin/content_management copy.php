<?= $this->extend("layouts/main") ?>

<?= $this->section('content'); ?>

<div class="max-w-7xl mx-auto">
    <?= $this->include("pages/admin/content/add_new_layanan") ?>

    <div class="w-full flex justify-between items-center">
        <h1 class="text-3xl font-semibold mb-6 text-[#505050]">Content Management</h1>
        <button id="add-new-layanan-modal-button" class="bg-b-green hover:bg-b-green-hover text-white p-4 py-2 rounded-md flex items-center space-x-1 transition-colors duration-200">
            <span>+</span><span>Tambah Layanan Baru</span>
        </button>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-5" id="layanan-lists">
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
        <?= $this->include("pages/admin/content/slide_show") ?>
        <?= $this->include("pages/admin/content/visi_misi") ?>
        <?= $this->include("pages/admin/content/staff") ?>
        <?= $this->include("pages/admin/content/tentang_kami") ?>
        <?= $this->include("pages/admin/content/sejarah") ?>
        <?php foreach ($layanan as $item) { ?>
            <?= view("pages/admin/content/layanan", [
                "underscore" => $item['landing_page_content_id'],
                "layanan_title" => formatPathToTitle($item['landing_page_content_id']),
                "dash" => pathToDash($item['landing_page_content_id']),
                "camel" => underscoreToCamelCase($item['landing_page_content_id'])
            ]) ?>
        <?php } ?>
    </div>
</div>


<div id="staffModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4 py-10">
    <div class="bg-white rounded-lg w-full h-fit">
        <!-- Header Modal -->
        <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
            <h3 id="staffModalTitle" class="text-xl font-semibold text-[#505050]">Tambah Staf</h3>
            <button id="closeStaffModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Content Modal -->
        <div class="h-max">
            <form id="staffForm" enctype="multipart/form-data" class="p-6">
                <input type="hidden" id="staffId">

                <div class="grid grid-cols-2 gap-8">
                    <!-- Kolom Kiri - Foto dan Data Dasar -->
                    <div class="space-y-6">
                        <!-- Foto Profil -->
                        <div>
                            <label for="staffPhoto" class="block text-sm font-medium text-gray-700 mb-3">Foto Profil</label>
                            <div class="flex flex-col items-center">
                                <div class="relative mb-4">
                                    <img id="photoPreview" src="" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 hidden">
                                    <div id="photoPlaceholder" class="w-32 h-32 rounded-full bg-gray-100 border-4 border-dashed border-gray-300 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <input type="file" id="staffPhoto" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            </div>
                            <div id="currentPhoto" class="mt-3">
                                <p class="text-sm text-gray-500 text-center">Foto saat ini:</p>
                                <img id="currentPhotoImg" class="w-20 h-20 object-cover rounded-full mx-auto mt-2">
                            </div>
                        </div>

                        <!-- Data Dasar -->
                        <div class="space-y-4">
                            <div>
                                <label for="staffNIP" class="block text-sm font-medium text-gray-600 mb-1">NIP</label>
                                <input type="text" id="staffNIP" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>

                            <div>
                                <label for="staffEmail" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                <input type="email" id="staffEmail" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Tengah - Informasi Personal -->
                    <div class="space-y-6">
                        <!-- Informasi Personal -->
                        <div>
                            <h3 class="text-lg font-semibold text-t-gray mb-4">Informasi Personal</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="staffName" class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                                    <input type="text" id="staffName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>

                                <div>
                                    <label for="staffPosition" class="block text-sm font-medium text-gray-600 mb-1">Jabatan</label>
                                    <input type="text" id="staffPosition" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Media Sosial -->
                        <div>
                            <h3 class="text-lg font-semibold text-t-gray mb-4">Media Sosial</h3>
                            <div class="space-y-3">
                                <!-- Facebook -->
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label for="staffFacebook" class="block text-xs text-gray-500 mb-1">Facebook</label>
                                        <input type="text" id="staffFacebook" placeholder="username.facebook" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                    </div>
                                </div>

                                <!-- Instagram -->
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label for="staffInstagram" class="block text-xs text-gray-500 mb-1">Instagram</label>
                                        <input type="text" id="staffInstagram" placeholder="@username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                    </div>
                                </div>

                                <!-- LinkedIn -->
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <label for="staffLinkedIn" class="block text-xs text-gray-500 mb-1">LinkedIn</label>
                                        <input type="text" id="staffLinkedIn" placeholder="linkedin.com/in/username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-between">
                    <div>
                        <!-- Spacer untuk alignment -->
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="flex justify-end space-x-3">
                            <button type="button" id="cancelStaffEdit" class="px-6 py-2.5 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-200 transition-colors duration-200 font-medium">
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-b-green text-white rounded-md hover:bg-b-green-hover transition-colors duration-200 font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    const staffModal = document.getElementById('staffModal');
    const closeStaffModal = document.getElementById('closeStaffModal');
    const cancelStaffEdit = document.getElementById('cancelStaffEdit');
    const staffForm = document.getElementById('staffForm');
    const staffModalTitle = document.getElementById('staffModalTitle');

    document.addEventListener('DOMContentLoaded', function() {
        renderStaffTable();
        closeStaffModal.addEventListener('click', closeStaffModalFunc);
        cancelStaffEdit.addEventListener('click', closeStaffModalFunc);
        staffForm.addEventListener('submit', saveStaffData);
    });

    // === 🧩 MODAL HANDLERS ===
    function openStaffModalForAdd() {
        staffModalTitle.textContent = "Tambah Staf Baru";
        staffForm.reset();
        document.getElementById('currentPhoto').classList.add('hidden');
        staffModal.classList.remove('hidden');
    }

    function closeStaffModalFunc() {
        staffModal.classList.add('hidden');
    }

    // === 🧩 RENDER TABLE ===
    async function renderStaffTable() {
        const staffTableBody = document.getElementById("staffTableBody");
        try {
            const response = await Api.get("/api/public/staff");
            const staffList = response.data;

            staffTableBody.innerHTML = "";

            staffList.forEach((staff) => {
                const row = document.createElement("tr");
                row.classList.add("border-b", "border-gray-100");

                row.innerHTML = `
                    <td class="px-4 py-3">
                        <img src="${staff.image || '/images/default-avatar.png'}"
                             class="w-9 h-9 rounded-sm object-cover">
                    </td>
                    <td class="px-4 py-3 text-gray-700">${staff.name}</td>
                    <td class="px-4 py-3 text-gray-700">${staff.role}</td>
                    <td class="px-4 py-3 text-right space-x-5 space-y-3">
                        <button class="editStaffBtn bg-base-blue text-white px-3 py-2.5 rounded-md hover:bg-base-hover"
                                data-id="${staff.nip}">
                            <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379
                                5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </button>
                        <button class="deleteStaffBtn bg-red-600 text-white px-3 py-2.5 rounded-md hover:bg-[#D80000]"
                                data-id="${staff.nip}">
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                    01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0
                                    00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </td>
                `;
                staffTableBody.appendChild(row);
            });

            // ✅ Tambah event listener edit & delete
            document.querySelectorAll(".editStaffBtn").forEach((btn) => {
                btn.addEventListener("click", async (e) => {
                    const nip = e.currentTarget.dataset.id;
                    try {
                        const res = await Api.get(`/api/public/staff/${nip}`);
                        console.log(res)
                        openStaffModalForEdit(res.data);
                    } catch (err) {
                        console.error("Gagal ambil data staff:", err);
                        alert("Gagal ambil data staff!");
                    }
                });
            });

            document.querySelectorAll(".deleteStaffBtn").forEach((btn) => {
                btn.addEventListener("click", async (e) => {
                    const id = e.currentTarget.dataset.id;
                    deleteStaff(id);
                });
            });
        } catch (err) {
            console.error("Error fetching staff data:", err);
        }
    }

    // === 🧩 EDIT MODAL ===
    function openStaffModalForEdit(staffData) {
        staffModalTitle.textContent = "Edit Data Staf";

        // ✅ isi field dasar
        document.getElementById("staffNIP").value = staffData.nip || "";
        document.getElementById("staffEmail").value = staffData.email || "";
        document.getElementById("staffName").value = staffData.name || "";
        document.getElementById("staffPosition").value = staffData.role || "";

        // ✅ amanin data medsos biar gak error
        let medsosList = [];

        if (Array.isArray(staffData.medsos)) {
            medsosList = staffData.medsos;
        } else if (typeof staffData.medsos === "string") {
            // handle pemisah koma / titik koma
            medsosList = staffData.medsos.split(/[;,]+/);
        } else if (staffData.medsos && typeof staffData.medsos === "object") {
            // kalau medsos berupa object (misal {facebook:..., instagram:...})
            medsosList = [
                staffData.medsos.facebook || "",
                staffData.medsos.instagram || "",
                staffData.medsos.linkedin || ""
            ];
        }

        document.getElementById("staffFacebook").value = medsosList[0] || "";
        document.getElementById("staffInstagram").value = medsosList[1] || "";
        document.getElementById("staffLinkedIn").value = medsosList[2] || "";

        // ✅ tampilkan foto kalau ada
        const currentPhotoImg = document.getElementById("currentPhotoImg");
        const currentPhoto = document.getElementById("currentPhoto");
        currentPhoto.classList.remove("hidden");
        currentPhotoImg.src = staffData.image

        staffModal.classList.remove("hidden");
    }

    // === 🧩 DELETE STAFF ===
    async function deleteStaff(id) {
        if (!confirm("Yakin mau hapus data ini?")) return;
        try {
            await Api.del(`/api/admin/staff/${id}`);
            alert("Staff berhasil dihapus!");
            renderStaffTable();
        } catch (err) {
            console.error("Gagal hapus staff:", err);
            alert("Gagal menghapus data staff.");
        }
    }

    // === 🧩 SAVE STAFF ===
    async function saveStaffData(e) {
        e.preventDefault();

        const nip = document.getElementById('staffNIP').value.trim();
        const email = document.getElementById('staffEmail').value.trim();
        const name = document.getElementById('staffName').value.trim();
        const role = document.getElementById('staffPosition').value.trim();
        const facebook = document.getElementById('staffFacebook').value.trim();
        const instagram = document.getElementById('staffInstagram').value.trim();
        const linkedin = document.getElementById('staffLinkedIn').value.trim();
        const photoFile = document.getElementById('staffPhoto').files[0];

        const formData = new FormData();
        formData.append("data", JSON.stringify({
            nip,
            email,
            name,
            role,
            medsos: [facebook, instagram, linkedin].filter(Boolean).join(';')
        }));

        if (photoFile) formData.append("image", photoFile);

        const token = localStorage.getItem("jwt_token");

        // ✅ logic endpoint: create dan update pakai POST
        // tapi update ada tambahan /<nip>
        const url = `/api/admin/staff${nip ? '/' + nip : ''}`;

        try {
            const res = await fetch(url, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`
                },
                body: formData
            });

            const result = await res.json();

            if (result.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: nip ? "Data staff berhasil diperbarui ✅" : "Staff baru berhasil ditambahkan ✅",
                    confirmButtonText: "OK",
                    timer: 2000,
                    willClose: () => location.reload()
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: result.message || "Operasi gagal ❌",
                    confirmButtonText: "OK"
                });
            }
        } catch (err) {
            console.error("Gagal simpan data staff:", err);
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Terjadi kesalahan saat menyimpan data ❌",
                confirmButtonText: "OK"
            });
        }
    }

    // === 🧩 PREVIEW PHOTO ===
    document.getElementById('staffPhoto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview = document.getElementById('photoPreview');
            preview.src = ev.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
<?= $this->endSection(); ?>
