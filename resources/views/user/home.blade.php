<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS-->
    <link href="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card px-3 py-5 mt-5">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <h1 class="text-success">User Home Page</h1>
                <h3>role -> {{ Auth::user()->role }}</h3>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Soluta, nisi numquam quis officiis repudiandae placeat obcaecati voluptate libero, sapiente esse amet voluptatem inventore, laborum modi rerum odio error reprehenderit aperiam.Dolorem nisi eius voluptate recusandae sequi quidem ducimus distinctio deserunt velit tenetur, consequatur deleniti reprehenderit neque, voluptatibus consequuntur eveniet ut necessitatibus. Molestias nisi animi magni dolore reiciendis delectus repellat provident.
        </p>
        <button class="btn btn-danger" type="submit">logout</button>
        <a href="{{route('admin#changePasswordPage')}}">
            <button class="btn btn-dark">Change Password</button>
        </a>
    </form>
</div>
</div>
</body>
</html>
