<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Products') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    Products >> <a href="{{  route('index')  }}">Listing</a> || <a href="{{  route('create')  }}">Create</a>
    <h1>Products</h1>

 {{--  {{  dd($products[0]->name) }} --}}

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Brand</th>
      <th scope="col">Type</th>
     <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($products as $product)
    <tr>

      <td>{{ $product->id }}</td>
      <td><a href="{{ route('edit', [$product->id]) }}">{{ $product->code }}</a></td>
      <td>{{ $product->name }}</td>
      <td>{{ $product->category }}</td>
      <td>{{ $product->brand  }}</td>
      <td>{{ $product->type }}</td>
      <td>{{ $product->description }}</td>

    </tr>
   @endforeach
  </tbody>
</table>
    <div class="row text-center"> {!! $products->links() !!}</div>
</body>
</html>


<script>
@if (session('status'));
alert("{{ session('status') }}" );
@endif
</script>

