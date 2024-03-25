<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
<h1>Create a Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="short_description">Short Description:</label>
    <textarea id="short_description" name="short_description" required></textarea><br><br>

    <label for="long_description">Long Description:</label>
    <textarea id="long_description" name="long_description" required></textarea><br><br>

    <label for="is_simple">Is Simple:</label>
    <input type="checkbox" id="is_simple" name="is_simple" value="1"><br><br>

    <label for="main_picture_url">Main Picture URL:</label>
    <input type="text" id="main_picture_url" name="main_picture_url"><br><br>

    <label for="is_active">Is Active:</label>
    <input type="checkbox" id="is_active" name="is_active" value="1" checked><br><br>

    <label for="slug">Slug:</label>
    <input type="text" id="slug" name="slug" required><br><br>

    <button type="submit">Create Product</button>
</form>

</body>
</html>
