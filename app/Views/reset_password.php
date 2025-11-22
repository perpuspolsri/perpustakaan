<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - UPT Perpustakaan Politeknik Negeri Sriwijaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script>
        // setTimeout(() => {
        //     window.location.href = '/login';
        // }, 1000);
    </script>
    <style>
        .loader {
            --c1: #000000;
            --c2: #16476A;
            width: 30px;
            height: 60px;
            border-top: 4px solid var(--c1);
            border-bottom: 4px solid var(--c1);
            background: linear-gradient(90deg, var(--c1) 2px, var(--c2) 0 5px, var(--c1) 0) 50%/7px 8px no-repeat;
            display: grid;
            overflow: hidden;
            animation: l5-0 2s infinite linear;
        }

        .loader::before,
        .loader::after {
            content: "";
            grid-area: 1/1;
            width: 75%;
            height: calc(50% - 4px);
            margin: 0 auto;
            border: 2px solid var(--c1);
            border-top: 0;
            box-sizing: content-box;
            border-radius: 0 0 40% 40%;
            -webkit-mask:
                linear-gradient(#000 0 0) bottom/4px 2px no-repeat,
                linear-gradient(#000 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            background:
                linear-gradient(var(--d, 0deg), var(--c2) 50%, #0000 0) bottom /100% 205%,
                linear-gradient(var(--c2) 0 0) center/0 100%;
            background-repeat: no-repeat;
            animation: inherit;
            animation-name: l5-1;
        }

        .loader::after {
            transform-origin: 50% calc(100% + 2px);
            transform: scaleY(-1);
            --s: 3px;
            --d: 180deg;
        }

        @keyframes l5-0 {
            80% {
                transform: rotate(0)
            }

            100% {
                transform: rotate(0.5turn)
            }
        }

        @keyframes l5-1 {

            10%,
            70% {
                background-size: 100% 205%, var(--s, 0) 100%
            }

            70%,
            100% {
                background-position: top, center
            }
        }
    </style>
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

<body class="font-gabarito text-[#505050]">
    <div class="flex items-center justify-center min-h-screen w-full">
        <div class="w-2/3 md:w-1/3 border border-gray-300 p-3 rounded">
            <h1 class="text-2xl font-semibold">Reset Password</h1>
            <div id="alertMessage" class="hidden"></div>
            <form id="loginForm" class="mt-2">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-3 pr-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-base-blue transition duration-200"
                            placeholder="Masukkan password baru"
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

                <button
                    type="submit"
                    class="mt-3 w-full bg-base-blue hover:bg-base-hover text-white font-medium py-3 px-4 rounded-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                    id="submitBtn">
                    <i class="fas fa-floppy-disk mr-2"></i>
                    <span id="submitText">Simpan Password</span>
                    <span id="loadingSpinner" class="hidden ml-2">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.classList.add('animate-fade-in');

            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const alertMessage = document.getElementById('alertMessage');

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

                alertMessage.classList.add('hidden');

                const password = passwordInput.value;

                if (!password) {
                    showError('password', 'Password harus diisi');
                    return;
                }

                submitBtn.disabled = true;
                loadingSpinner.classList.remove('hidden');
                submitText.textContent = 'Sedang login...';

                try {
                    let endpoint, payload;
                    endpoint = '<?= base_url('api/auth/reset-password') ?>';

                    const params = new URLSearchParams(window.location.search);
                    const token = params.get('token');

                    payload = {
                        token: token,
                        password: password
                    };

                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(payload)
                    });

                    const data = await response.json();

                    if (data.status == false) {
                        showAlert(data.message);
                    } else {
                        showAlert("Password Berhasil Diubah. Mengarahkan Ke Login ...", "success");
                        setTimeout(() => {
                            window.location.href = '<?= base_url('login') ?>';
                        }, 2000);
                    }

                } catch (error) {
                    console.error('Login error:', error);
                    showAlert('Terjadi kesalahan saat login. Silakan coba lagi.');
                } finally {
                    submitBtn.disabled = false;
                    loadingSpinner.classList.add('hidden');
                    submitText.textContent = "Simpan Password";
                }
            });

            passwordInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });
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
