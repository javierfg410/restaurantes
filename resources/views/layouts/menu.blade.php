<!-- need to remove -->
@if (Auth::user()->role[0]->id_role === 1)
@elseif (Auth::user()->role[0]->id_role === 2)
<li class="nav-item">
    <a href="/restaurante" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Restaurantes</p>
    </a>
</li>
@endif

