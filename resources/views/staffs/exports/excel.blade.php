<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Cargo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($staffs as $staff)
            <tr>
                <td>
                    {{ $loop->index + 1 }}
                </td>
                <td>
                    {{ $staff->name }}
                </td>
                <td>
                    {{ $staff->job }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>