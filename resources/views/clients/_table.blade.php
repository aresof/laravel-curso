<table class="table table-striped">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>NIF</th>
        <th>Teléfono1</th>
        <th>-</th>
    </tr>
    </thead>
    <tbody>
    @each('clients._list_item', $clients, 'client', 'clients._list_item_empty')
    </tbody>
</table>