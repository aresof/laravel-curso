<tr>
    <td>{{$product->name}}</td>
    <td>{{$product->price}}</td>
    <td><a href="{{route('products.show',[$product->id])}}">Ver</a></td>
</tr>