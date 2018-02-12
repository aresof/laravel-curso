<table class="table table-striped">
    <thead>
    <tr>
        <th>IdProducto</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>-</th>
    </tr>
    <tr>
        <form action="{{ route('products.search') }}" method="get">
        <th><input type="text" class="form-control" placeholder="Buscar por Id" name="id"></th>
        <th><input type="text" class="form-control" placeholder="Buscar por Nombre" name="name"></th>
        <th><input type="text" class="form-control" placeholder="Buscar por Precio" name="price"></th>
        <th><input type="submit" value="Buscar"></th>
        </form>
    </tr>
    </thead>
    <tbody>
    @each('products._list_item', $products, 'product', 'products._list_item_empty')
    </tbody>
</table>