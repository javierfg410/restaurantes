<!-- Menu para listar usuarios || solo visible para el admin -->
@if (Auth::user()->role[0]->id_role === 1)
<li class="nav-item">
    <a href="/users" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Usuarios</p>
    </a>
</li>
@elseif (Auth::user()->role[0]->id_role === 2)

@endif
<!-- Menu para listar Restaurants || visible para todos || El apartado imagenes se accede desde el menu restaurantes -->
<li class="nav-item">
    <a href="/restaurants" class="nav-link">
        <i class="nav-icon fas fa-utensils"></i>
        <p>Restaurantes</p>
    </a>
</li>


