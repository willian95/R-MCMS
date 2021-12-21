<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sizes as $size)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $size->size }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>