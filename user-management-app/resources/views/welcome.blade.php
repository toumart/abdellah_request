<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            animation: fadeInCard 0.5s ease-in-out;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, .25);
        }

        .btn-custom {
            width: 100%;
            padding: 12px;
            font-weight: bold;
        }

        .custom-file-input::file-selector-button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            margin-right: 10px;
        }

        .alert-custom {
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            animation: fadeInAlert 0.6s ease-in-out;
        }

        body.dark-mode {
    background-color: #121212;
    color: #ffffff;
}

body.dark-mode .card {
    background-color: #1f1f1f;
    color: #ffffff;
    border: 1px solid #333;
}

body.dark-mode .form-control {
    background-color: #2c2c2c;
    color: #ffffff;
    border-color: #444;
}

body.dark-mode .form-control::placeholder {
    color: #cccccc;
}

body.dark-mode .btn {
    border: none;
}

body.dark-mode .btn-primary {
    background-color: #0d6efd;
}

body.dark-mode .btn-success {
    background-color: #198754;
}

body.dark-mode .btn-warning {
    background-color: #ffc107;
    color: black;
}

body.dark-mode .btn-dark {
    background-color: #444;
}

body.dark-mode .toast {
    background-color: #2e2e2e;
    color: #fff;
}


        @keyframes fadeInAlert {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .card {
                width: 100%;
            }

            .container {
                padding: 10px;
            }

            html,
            body {
                height: 100%;
            }
        }

        #liveResults {
    max-height: 200px;
    overflow-y: auto;
    border-radius: 0 0 10px 10px;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

    </style>
</head>

<body>
<div class="position-fixed top-0 start-0 p-3" style="z-index: 10000;">
    <button id="darkModeToggle" class="btn btn-outline-secondary">
        🌓 Toggle Dark Mode
    </button>
</div>


<!-- ✅ Toast Notifications -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('not_found'))
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ❌ {{ session('not_found') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

<div class="container py-5">

    <!-- ✅ Section 1: Registration -->
    <div class="mb-5">
        <h2 class="text-center mb-4">User Registration</h2>

        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <form method="POST" action="/register">
                @csrf
                <div class="mb-3">
                    <input name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" required>
                    @error('name')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                    @error('email')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" required>
                    @error('phone')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" required>
                    @error('dob')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-primary btn-custom">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ✅ Section 2: Search -->
    <div class="mb-5">
        <h2 class="text-center mb-4">Search User</h2>

        <div class="card p-4 mx-auto" style="max-width: 600px;">
            <form method="GET" action="/search">
            <input id="searchInput" name="query" class="form-control mb-2" placeholder="Start typing name or email..." autocomplete="off">
<div id="liveResults" class="list-group position-absolute w-100 mt-1" style="z-index: 999;"></div>
                <div class="text-center">
                    <button class="btn btn-success btn-custom">Search</button>
                </div>
            </form>

            @if(session('result'))
    @php $user = session('result'); @endphp
    <div class="card mt-4 p-3 shadow-sm" style="animation: fadeInCard 0.5s ease-in-out;">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h5 class="mb-0">👤 <strong>{{ $user['name'] }}</strong><br></h5>
            <span class="badge bg-primary">Found</span>
        </div>
        <p class="mb-1">📧 <strong>Email:</strong> {{ $user->email }}</p>
        <p class="mb-1">📞 <strong>Phone:</strong> {{ $user->phone }}</p>
        <p class="mb-0">📅 <strong>DOB:</strong> {{ $user->dob }}</p>
    </div>
@endif

        </div>
    </div>

    <!-- ✅ Section 3: Import/Export -->
    <div class="mb-5">
        <h2 class="text-center mb-4">Import or Export Data</h2>

        <div class="card p-4 mx-auto" style="max-width: 600px;">
        <form action="/import" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file" class="form-label">📂 Choose file to import</label>
    <input type="file" name="file" class="form-control mb-3" required>
    @if($errors->has('file'))
    <div class="alert alert-danger alert-custom mt-2">
        ❌ {{ $errors->first('file') }}
    </div>
@endif
    <div class="text-center">
        <button type="submit" class="btn btn-warning btn-custom mb-2">📤 Import Users</button>
    </div>
</form>
            <div class="text-center">
                <a href="/export" class="btn btn-dark btn-custom">📥 Export Users</a>
            </div>
        </div>
    </div>

</div>

<!-- ✅ Bootstrap Toast Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toast').forEach(toast => {
        new bootstrap.Toast(toast, { delay: 5000 }).show();
    });
</script>

<script>
    // Load dark mode preference
    if (localStorage.getItem('dark-mode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }

    document.getElementById('darkModeToggle').addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('dark-mode', isDark ? 'enabled' : 'disabled');
    });
</script>


<script>
    const searchInput = document.getElementById('searchInput');
    const resultBox = document.getElementById('liveResults');

    searchInput.addEventListener('keyup', function () {
        const query = this.value;

        if (query.length > 1) {
            fetch(`/live-search?query=${query}`)
                .then(res => res.json())
                .then(data => {
                    resultBox.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(user => {
                            const item = document.createElement('a');
                            item.href = `/search?query=${user.email}`;
                            item.className = 'list-group-item list-group-item-action';
                            item.innerHTML = `
                                <strong>${user.name}</strong><br>
                                <small>${user.email}</small>
                            `;
                            resultBox.appendChild(item);
                        });
                    } else {
                        resultBox.innerHTML = `<div class="list-group-item disabled">No matches found</div>`;
                    }
                });
        } else {
            resultBox.innerHTML = '';
        }
    });

    // Optional: Hide suggestions if clicked outside
    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !resultBox.contains(e.target)) {
            resultBox.innerHTML = '';
        }
    });
</script>


</body>
</html>
