<!DOCTYPE html>
<html>

<head>
    <title>Logout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script>
        localStorage.removeItem('jwt_token');
        localStorage.removeItem('user_role');
        localStorage.removeItem('token_type');

        setTimeout(() => {
            window.location.href = '/login';
        }, 1000);
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

<body class="font-gabarito">
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center flex justify-center items-center flex-col gap-3">
            <div class="loader"></div>
            <p>Logging out...</p>
        </div>
    </div>
</body>

</html>
