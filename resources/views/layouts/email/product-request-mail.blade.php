<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Product Request</title>
</head>
<body>
<h3>New Product Request from {{$request->name}}</h3>
<br>
<br>
<h5>Product Info:</h5>
<p>Product ID: {{$request->product->id}}</p>
<p>Product Name: {{$request->product->name}}</p>

<br> <br>
<h5>User Info</h5>
<p>Name: {{$request->name}}</p>
<p>Email: {{$request->email}}</p>
<p>Phone: {{$request->phone}}</p>
<p>CVR Number: {{$request->cvr_number}}</p>
<p>Note: {{$request->note}}</p>
</body>
</html>
