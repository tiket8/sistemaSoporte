<nav class="sidebar bg-dark">
    <ul class="list-unstyled p-3">
        <li>
            <a href="/" class="text-white text-decoration-none">
                <i class="bi bi-house"></i> Inicio
            </a>
        </li>

        <!-- Opciones del Administrador -->
        @if(auth()->user()->rol == 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('categoria.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-folder"></i> Mant. Categoría
                </a>
            </li>
            <li>
                <a href="{{ route('subcategoria.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-folder2"></i> Mant. Subcategoría
                </a>
            </li>
            <li>
                <a href="{{ route('prioridad.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-flag"></i> Mant. Prioridad
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="text-white text-decoration-none">
                    <i class="fa fa-users"></i> <span>Mant. Usuario</span>
                </a>
            </li>
        @endif

        <!-- Opciones para Soporte -->
        @if(auth()->user()->rol == 'soporte')
            <li>
                <a href="{{ route('soporte.dashboard') }}" class="text-white text-decoration-none">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('soporte.tickets.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-ticket"></i> Consultar Tickets
                </a>
            </li>
            <li>
                <a href="{{ route('soporte.tickets.create') }}" class="text-white text-decoration-none">
                    <i class="bi bi-plus-circle"></i> Crear Ticket
                </a>
            </li>
        @endif

        <!-- Opciones para Cliente -->
        @if(auth()->user()->rol == 'cliente')
            <li>
                <a href="{{ route('cliente.dashboard') }}" class="text-white text-decoration-none">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('cliente.tickets.index') }}" class="text-white text-decoration-none">
                    <i class="bi bi-ticket"></i> Consultar Tickets
                </a>
            </li>
            <li>
                <a href="{{ route('cliente.tickets.create') }}" class="text-white text-decoration-none">
                    <i class="bi bi-plus-circle"></i> Crear Ticket
                </a>
            </li>
        @endif

        <!-- Cerrar Sesión -->
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
