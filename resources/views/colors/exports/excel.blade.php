<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Hex</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colors as $color)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $color->color }}
                </td>
                <td>
                    {{ $color->hex }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>