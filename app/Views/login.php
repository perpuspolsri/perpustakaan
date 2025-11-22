<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    gabarito: ['Gabarito', 'sans-serif'],
                },
                colors: {
                    "base-blue": "#16476A",
                    "t-gray": "#505050",
                    "base-hover": "#033554ff",
                    "b-green": "#009358",
                    "b-green-hover": "#037748ff",
                }
            },
        },
    }
</script>

<body class="h-screen w-full flex px-5 md:px-0 flex-col md:flex-row items-center justify-center gap-10 font-gabarito text-t-gray">
    <div class="w-2/5 hidden md:flex">
        <img src="/img/login-illustration.svg" alt="" class="w-full">
    </div>
    <div class="bg-white p-8 rounded-lg border border-gray-300 w-full md:w-1/3 flex flex-col gap-5">
        <a href="/">
            <div class="w-full flex items-center gap-3">
                <img src="/img/polsri.png" alt="" class="w-10 h-10">
                <h1 class="text-lg md:text-2xl font-bold ">UPT Perpustakaan POLSRI</h1>
            </div>
        </a>

        <!-- Alert Messages -->
        <div id="alertMessage" class="hidden"></div>

        <form id="loginForm">
            <?= csrf_field() ?>
            <input type="hidden" name="role" id="formRole" value="admin">

            <div class="flex flex-col gap-3 ">
                <div class="flex flex-col gap-1">
                    <label class="block text-sm font-medium text-gray-700">
                        Login Sebagai
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            id="adminBtn"
                            class="role-btn flex flex-col items-center justify-center p-4 border-2 border-base-blue bg-blue-50 text-base-blue rounded-md transition duration-200 hover:bg-blue-100 hover:shadow-md"
                            data-role="admin">
                            <span class="font-medium">Admin</span>
                        </button>

                        <button
                            type="button"
                            id="memberBtn"
                            class="role-btn flex flex-col items-center justify-center p-4 border-2 border-gray-300 bg-gray-50 text-gray-700 rounded-md transition duration-200 hover:bg-gray-100 hover:shadow-md"
                            data-role="member">
                            <span class="font-medium">Mahasiswa</span>
                        </button>
                    </div>
                </div>

                <!-- Username/Member ID Field -->
                <div class="flex flex-col gap-1">
                    <label id="usernameLabel" for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-base-blue transition duration-200"
                            placeholder="Masukkan username Anda"
                            required>
                    </div>
                    <p id="usernameError" class="text-red-500 text-xs mt-1 flex items-center hidden">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span id="usernameErrorText"></span>
                    </p>
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-base-blue transition duration-200"
                            placeholder="Masukkan password Anda"
                            required>
                        <!-- Eye Icon untuk Show/Hide Password -->
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    <p id="passwordError" class="text-red-500 text-xs mt-1 flex items-center hidden">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span id="passwordErrorText"></span>
                    </p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="mt-3 w-full bg-base-blue hover:bg-base-hover text-white font-medium py-3 px-4 rounded-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    id="submitBtn">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span id="submitText">Login sebagai Admin</span>
                    <span id="loadingSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </button>

                <button
                    type="button"
                    class="hidden w-full bg-base-blue hover:bg-base-hover text-white font-medium py-3 px-4 rounded-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    id="resetBtn">
                    <i class="fas fa-lock mr-2"></i>
                    <span id="submitTextReset">Reset Password</span>
                    <span id="loadingSpinnerReset" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-gray-600">
                &copy; <?= date('Y') ?> UPT Perpustakaan POLSRI. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        class AuthHelper {
            static getToken() {
                return localStorage.getItem('jwt_token');
            }

            static getRole() {
                return localStorage.getItem('user_role');
            }

            static getTokenType() {
                return localStorage.getItem('token_type');
            }

            static isAuthenticated() {
                return !!this.getToken();
            }

            static logout() {
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user_role');
                localStorage.removeItem('token_type');
                window.location.href = '/logout';
            }

            static async makeAuthenticatedRequest(url, options = {}) {
                const token = this.getToken();
                const tokenType = this.getTokenType();

                if (!token) {
                    this.logout();
                    throw new Error('No token found');
                }

                const defaultOptions = {
                    headers: {
                        'Authorization': `${tokenType} ${token}`,
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                };

                const mergedOptions = {
                    ...defaultOptions,
                    ...options,
                    headers: {
                        ...defaultOptions.headers,
                        ...options.headers
                    }
                };

                try {
                    const response = await fetch(url, mergedOptions);

                    if (response.status === 401) {
                        this.logout();
                        throw new Error('Token expired or invalid');
                    }

                    return response;
                } catch (error) {
                    console.error('API Request error:', error);
                    throw error;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.classList.add('animate-fade-in');

            const adminBtn = document.getElementById('adminBtn');
            const memberBtn = document.getElementById('memberBtn');
            const usernameInput = document.getElementById('username');
            const usernameLabel = document.getElementById('usernameLabel');
            const formRole = document.getElementById('formRole');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const submitTextReset = document.getElementById('submitTextReset');
            const loadingSpinnerReset = document.getElementById('loadingSpinnerReset');
            const alertMessage = document.getElementById('alertMessage');
            const resetBtn = document.getElementById('resetBtn');

            let currentRole = 'member';
            selectRole(currentRole);

            function showAlert(message, type = 'error') {
                alertMessage.className = `px-4 py-3 rounded mb-4 flex items-center ${
                    type === 'error'
                    ? 'bg-red-100 border border-red-400 text-red-700'
                    : 'bg-green-100 border border-green-400 text-green-700'
                }`;
                alertMessage.innerHTML = `
                    <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'} mr-2"></i>
                    <span class="text-sm">${message}</span>
                `;
                alertMessage.classList.remove('hidden');

                setTimeout(() => {
                    alertMessage.classList.add('hidden');
                }, 5000);
            }

            function showError(field, message) {
                const errorElement = document.getElementById(`${field}Error`);
                const errorText = document.getElementById(`${field}ErrorText`);

                errorText.textContent = message;
                errorElement.classList.remove('hidden');
                document.getElementById(field).classList.add('border-red-500');
            }

            function clearErrors() {
                ['username', 'password'].forEach(field => {
                    document.getElementById(`${field}Error`).classList.add('hidden');
                    document.getElementById(field).classList.remove('border-red-500');
                });
            }

            function selectRole(role) {
                currentRole = role;

                document.querySelectorAll('.role-btn').forEach(btn => {
                    btn.classList.remove('border-base-blue', 'bg-blue-50', 'text-base-blue');
                    btn.classList.add('border-gray-300', 'bg-gray-50', 'text-gray-700');
                });

                const selectedBtn = document.querySelector(`[data-role="${role}"]`);
                selectedBtn.classList.remove('border-gray-300', 'bg-gray-50', 'text-gray-700');
                selectedBtn.classList.add('border-base-blue', 'bg-blue-50', 'text-base-blue');

                if (role === 'admin') {
                    usernameLabel.innerHTML = 'Username';
                    usernameInput.placeholder = 'Masukkan username Anda';
                    submitText.textContent = 'Login sebagai Admin';
                    submitBtn.className = submitBtn.className.replace('bg-green-600', 'bg-base-blue').replace('hover:bg-green-700', 'hover:bg-blue-700');
                    submitBtn.classList.add('bg-base-blue', 'hover:bg-blue-700');
                } else {
                    usernameLabel.innerHTML = 'NPM';
                    usernameInput.placeholder = 'Masukkan NPM Anda';
                    submitText.textContent = 'Login sebagai Mahasiswa';
                    submitBtn.className = submitBtn.className.replace('bg-base-blue', 'bg-green-600').replace('hover:bg-blue-700', 'hover:bg-green-700');
                    submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                }

                formRole.value = role;
                clearErrors();
                alertMessage.classList.add('hidden');
            }

            adminBtn.addEventListener('click', () => selectRole('admin'));
            memberBtn.addEventListener('click', () => selectRole('member'));

            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'text') {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                    this.classList.add('text-blue-600');
                } else {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                    this.classList.remove('text-blue-600');
                }
            });

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                clearErrors();
                alertMessage.classList.add('hidden');

                const username = usernameInput.value.trim();
                const password = passwordInput.value;
                const role = currentRole;

                if (!username) {
                    showError('username', 'Field ini harus diisi');
                    return;
                }

                if (!password) {
                    showError('password', 'Password harus diisi');
                    return;
                }

                submitBtn.disabled = true;
                loadingSpinner.classList.remove('hidden');
                submitText.textContent = 'Sedang login...';

                try {
                    let endpoint, payload;

                    if (role === 'admin') {
                        endpoint = '<?= base_url('api/auth/admin/login') ?>';
                        payload = {
                            username: username,
                            password: password
                        };
                    } else {
                        endpoint = '<?= base_url('api/auth/login') ?>';
                        payload = {
                            member_id: username,
                            password: password
                        };
                    }

                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.message == "Default Password") {
                        endpoint = '<?= base_url('api/auth/forgot-password') ?>';
                        resetBtn.classList.remove("hidden")
                        showAlert('Anda Belum Memiliki Password. Tekan Tombol Reset Password Untuk Membuat Password Baru');

                        payload = {
                            email: data.data.email,
                        };

                        resetBtn.addEventListener("click", async () => {
                            resetBtn.disabled = true;
                            loadingSpinnerReset.classList.remove('hidden');
                            submitTextReset.textContent = 'Sedang Diproses ...';

                            const response = await fetch(endpoint, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify(payload)
                            });

                            const data = await response.json();

                            if (data.status == true) {
                                showAlert(data.message, 'success');
                            } else {
                                showAlert(data.message, 'error');
                            }

                            resetBtn.disabled = false;
                            loadingSpinnerReset.classList.add('hidden');
                            submitTextReset.textContent = "Reset Password";
                            resetBtn.classList.add("hidden")
                        })

                    } else {
                        if (data.status === 'success') {
                            localStorage.setItem('jwt_token', data.token);
                            localStorage.setItem('user_role', role);
                            localStorage.setItem('token_type', 'Bearer');

                            showAlert('Login berhasil! Mengarahkan...', 'success');

                            setTimeout(() => {
                                if (role === 'admin') {
                                    window.location.href = '<?= base_url('admin/fines-management') ?>';
                                } else {
                                    window.location.href = '<?= base_url('member/loan') ?>';
                                }
                            }, 1000);
                        } else {
                            showAlert(data.message || 'Login gagal');

                            if (data.message?.includes('Username') || data.message?.includes('Member ID') || data.message?.includes('Invalid')) {
                                showError('username', data.message);
                            } else if (data.message?.includes('Password')) {
                                showError('password', data.message);
                            }
                        }
                    }

                } catch (error) {
                    console.error('Login error:', error);
                    showAlert('Terjadi kesalahan saat login. Silakan coba lagi.');
                } finally {
                    submitBtn.disabled = false;
                    loadingSpinner.classList.add('hidden');
                    submitText.textContent = role === 'admin' ? 'Login sebagai Admin' : 'Login sebagai Mahasiswa';
                }
            });

            passwordInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });

            if (AuthHelper.isAuthenticated()) {
                const role = AuthHelper.getRole();

                if (role === 'admin') {
                    window.location.href = '<?= base_url('admin/fines-management') ?>';
                } else if (role === 'member') {
                    window.location.href = '<?= base_url('member/dashboard') ?>';
                } else {
                    AuthHelper.logout();
                }
            }

            usernameInput.focus();
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .role-btn {
            transition: all 0.3s ease;
        }

        .role-btn:hover {
            transform: translateY(-2px);
        }

        #eyeIcon {
            transition: all 0.2s ease-in-out;
        }

        #togglePassword:hover #eyeIcon {
            transform: scale(1.1);
        }

        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</body>

</html>
