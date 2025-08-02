<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3">
    <div class="container-fluid">
        <span class="navbar-brand">Hai, {{ Auth::user()->name }}</span>

        <div class="d-flex">
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm" type="submit">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
