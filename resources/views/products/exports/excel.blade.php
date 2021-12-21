<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->category->name }}
                </td>
                <td>
                    {{ $product->brand->name }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>