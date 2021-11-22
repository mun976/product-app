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
    <h1>Create New Products</h1>
<form method="POST" action="{{ route('store',[]) }}">
     @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<table>
  <tr>
    <td>Code*: </td>
    <td><input type="text" id="code" name="code" size="40"></td>
  </tr>
   <tr>
     <td>Name*: </td>
     <td><input type="text" id="name" name="name" size="40"></td>
   </tr>

    <tr>
     <td>Category*: </td>
     <td> <input type="text" id="category" name="category" size="40"></td>
   </tr>

    <tr>
     <td>Brand: </td>
     <td><input type="text" id="brand" name="brand" size="40"></td>
   </tr>

    <tr>
     <td>Type: </td>
     <td><input type="text" id="type" name="type" size="40"></td>
   </tr>
 <tr>
     <td>Description: </td>
     <td><textarea id="description" name="description" rows="4" cols="40"></textarea></td>
   </tr>
 <tr>
    <td colspan="8" style="text-align: center;"><button type="submit" class="btn btn-primary btn-lg">Save</button></td>
</tr>

</table>
</form>
</body>
</html>


