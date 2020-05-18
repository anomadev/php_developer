@auth()
    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'onsubmit' => 'return confirm("Eliminar este producto")']) !!}
        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endauth
