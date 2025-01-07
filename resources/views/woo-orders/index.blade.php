<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD with Frontend</title>
</head>
<body>


    <div class="container">
        <h1>Add Order</h1>
    </div>

    <form method="POST" action="/woo-orders/create">
        @csrf

        <p>
            Product ID:
            <input type="text" name="order_id" required />
        </p>


        <p>
            SKU:
            <input type="text" name="customer_name" required />
        </p>

        <p>
            NAME:
            <input type="text" name="customer_email" required />
        </p>
    
        <p>
            QUANTITY:
            <input type="number" name="total" required />
        </p>

        <p>
            PRICE:
            <input type="text" name="status" required />
        </p>

        <button type="submit">Add Order</button>
    </form>




    @if ($updateOrder)
    <div class="container">
        <h1>Update Product</h1>
    </div>
    <form method="POST" action="/woo-orders">
        @csrf
        
        <p>
            ID:
            <input type="text" name="id"  value="{{ $updateOrder->id }}" />
        </p>


        <p>
            ORDER ID:
            <input type="text" name="order_id"  value="{{ $updateOrder->order_id }}" />
        </p>

        <p>
            NAME:
            <input type="text" name="customer_name"  value="{{ $updateOrder->customer_name }}" />
        </p>

        <p>
            EMAIL:
            <input type="text" name="customer_email" value="{{ $updateOrder->customer_email }}" />
        </p>
    
        <p>
            TOTAL:
            <input type="number" name="total" value="{{ $updateOrder->total }}" />
        </p>

        <p>
            STATUS:
            <input type="text" name="status" value="{{ $updateOrder->status }}"/>
        </p>

        <button type="submit" name="update-order" value="update">Update</button>
    </form>
    @endif


    <div class="container">
        <h1>Search Order</h1>
    </div>
    <form method="GET" action="/woo-orders">
        <input type="search" name="search" placeholder="Search for an order"/>
        <button type="submit">Search</button>
    </form>
    @if ($searchOrder)
        @foreach($searchOrder as $order)
            <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
            <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Customer Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Total:</strong> ${{ $order->total }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
        @endforeach
    @else
        <!-- <p>No orders found.</p> -->
    @endif


    <div class="container">
        <h1>Get Orders</h1>
    </div>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>${{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td> 
                        <a href="/woo-orders?update={{ $order->order_id }}">UPDATE</a> 
                        <form method="POST" action="/woo-orders/{{ $order->order_id }}" style="display:inline;">
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
