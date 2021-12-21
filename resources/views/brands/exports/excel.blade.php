<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($brands as $brand)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $brand->name }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>