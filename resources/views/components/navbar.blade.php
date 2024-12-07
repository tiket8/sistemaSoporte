<nav class="sidebar bg-dark">
    <ul class="list-unstyled p-3">
        <li>
            <a href="/" class="text-white text-decoration-none">
                <i class="bi bi-house"></i> Inicio
            </a>
        </li>
        <li>
            <a href="/admin/dashboard" class="text-white text-decoration-none">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="/tickets" class="text-white text-decoration-none">
                <i class="bi bi-ticket"></i> Consultar Tickets
            </a>
        </li>
        <li>
            <a href="/categoria" class="text-white text-decoration-none">
                <i class="bi bi-folder"></i> Mant. Categoría
            </a>
        </li>
        <li>
            <a href="/subcategoria" class="text-white text-decoration-none">
                <i class="bi bi-folder2"></i> Mant. Subcategoría
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">
                <i class="fa fa-users"></i> <span>Mant. Usuario</span>
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </button>
            </form>
        </li>
    </ul>
</nav>
