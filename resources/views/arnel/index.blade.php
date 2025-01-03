<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD with Frontend</title>
</head>
<body>



    <div class="container">
        <h1>Add Product</h1>
    </div>

    <form method="POST" action="/arnel/store">
        @csrf

        <p>
            Product ID:
            <input type="text" name="product_id" required />
        </p>


        <p>
            SKU:
            <input type="text" name="sku" required />
        </p>

        <p>
            NAME:
            <input type="text" name="name" required />
        </p>
    
        <p>
            QUANTITY:
            <input type="number" name="quantity" required />
        </p>

        <p>
            PRICE:
            <input type="number" name="price" required />
        </p>

        <button type="submit">Add Product</button>
    </form>




    @if ($updateProduct)
    <div class="container">
        <h1>Update Product</h1>
    </div>
    <form method="POST" action="/arnel">
        @csrf
        <p>
            ID:
            <input type="text" name="id"  value="{{ $updateProduct->id }}" />
        </p>
        
        <p>
            SKU:
            <input type="text" name="sku"  value="{{ $updateProduct->sku }}" />
        </p>

        <p>
            NAME:
            <input type="text" name="name" value="{{ $updateProduct->name }}" />
        </p>
    
        <p>
            QUANTITY:
            <input type="number" name="quantity" value="{{ $updateProduct->quantity }}" />
        </p>

        <p>
            PRICE:
            <input type="number" name="price" value="{{ $updateProduct->price }}"/>
        </p>

        <button type="submit" name="update-product" value="update">Update</button>
    </form>
    @endif





    <div class="container">
        <h1>Get Product</h1>
    </div>
    <form method="GET" action="/arnel">
        <input type="search" name="search" placeholder="Search for a product"/>
        <button type="submit">Search</button>
    </form>

    @if ($product)
        <p><strong>Product ID:</strong> {{ $product->id }}</p>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>SKU:</strong> {{ $product->sku }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
    @endif

    <div class="container">
        <h1>Get Products</h1>
    </div>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td> 
                        <a href="/arnel?update={{ $product->sku }}">UPDATE</a> 
                        <form method="POST" action="/arnel/{{ $product->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>
</html>
