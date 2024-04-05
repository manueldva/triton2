<div class="btn-group">
    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Acción
    </button>
    <ul class="dropdown-menu">
        @foreach ($menuItems as $item)
            @if($item['label'] == 'Eliminar')
                <li>
                    <form action="{{ $item['url'] }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            Eliminar
                        </button>
                    </form>
                </li>
            @else
                <li><a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
