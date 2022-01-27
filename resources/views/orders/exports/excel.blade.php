<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Status</th>
            <th>Total Productos</th>
            <th>Total Envío</th>
            <th>Total</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>
                    {{ $payment->wompi_reference }}
                </td>
                <td>
                    {{ $payment->name }}
                </td>
                <td>
                    {{ $payment->email }}
                </td>
                <td>
                    {{ $payment->address }}
                </td>
                <td>
                    {{ $payment->phone }}
                </td>
                <td>
                    {{ $payment->status }}
                </td>
                <td>
                    {{ $payment->total_products }}
                </td>
                <td>
                    {{ $payment->shipping_price }}
                </td>
                <td>
                    {{ $payment->total_products + $payment->shipping_price}}
                </td>
                <td>
                    {{ $payment->created_at->format('Y-m-d')}}
                </td>
            </tr>
            <tr>
                <td>Producto</td>
                <td>Precio</td>
                <td>Color</td>
                <td>Tamaño</td>
                <td>Cantidad</td>
                <td colspan="5"></td>

            </tr>
            @foreach($payment->productPurchases as $productPurchase)
            <tr>
                <td>{{ $productPurchase->productFormat->product->name }}</td>
                <td>{{ $productPurchase->productFormat->price }}</td>
                <td>{{ $productPurchase->productFormat->color->color }}</td>
                <td>{{ $productPurchase->productFormat->size->size }}</td>
                <td>{{ $productPurchase->amount }}</td>
                <td colspan="5"></td>
            </tr>
            @endforeach

            <tr>
                <td colspan="10"></td>
            </tr>
        @endforeach
    </tbody>
</table>