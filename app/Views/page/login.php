<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body class="text-center" style="background: url(https://images.unsplash.com/photo-1470219556762-1771e7f9427d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1953&q=80) center/cover #ffc107; position: relative">
    <style>
        form {
            border-radius: 10px;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-sizing: content-box;
            width: calc(100% - 30px) !important;
            border: 2px solid whitesmoke;
            background: #0003;
        }

        form a {
            font-weight: bold;
            color: var(--light);
        }

        .signin-group>button {
            width: 100%;
            margin-bottom: .5em;
            background: white;
        }


        .text-shadow {
            text-shadow: 0px 0px 2px black;
        }

        .floating {
            position: absolute;
            left: 10px;
            bottom: 10px;
        }

        .floating a {
            color: #fff6;
            transition: color 0.2s;
        }

        .floating a:hover {
            color: white;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            opacity: .8;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid white;
        }

        .separator::before {
            margin-right: .5em;
        }

        .separator::after {
            margin-left: .5em;
        }
    </style>
    <script>
		window.addEventListener('DOMContentLoaded', (event) => {
			var browser = navigator.userAgent.toLowerCase();
			if (browser.indexOf('firefox') > -1) {
				document.getElementsByTagName("form")[0].style.background = document.getElementsByTagName("body")[0].style.backgroundColor;
			}
		});
	</script>
    <div class="justify-content-center container d-flex flex-column" style="min-height: 100vh; max-width: 476px">
        <p class="mt-5"><a href="/"><img src="/3wedo.png" alt="Logo" width="150px"></a></p>
        <form method="POST" name="loginForm" class="container shadow d-flex flex-column justify-content-center pb-1 pt-3 text-white">
            <h1 class="mb-4">Enter to Portal</h1>
            <input type="text" name="nohp" placeholder="Nomor HP" class="form-control mb-2">
            <input type="password" name="password" autocomplete="current-password" placeholder="Password" class="form-control mb-2">
            <input type="submit" value="Sign In" class="btn-primary btn btn-block mb-3">
            <div class="separator mb-3">Or</div>
            <a href="/home/" class="btn d-flex align-items-center btn-light border-secondary mb-2">
                <span class="mx-auto">Kembali</span>
            </a>
        </form>
        <div class="floating">
            <small>
                <a href="https://unsplash.com/photos/ukvgqriuOgo" target="_blank" rel="noopener noreferrer">Background by Henning Witzel</a>
            </small>
        </div>
    </div>
</body>

</html>