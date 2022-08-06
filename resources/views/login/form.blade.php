<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css.bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Fashion Store</title>
    </head>
<body>
    <form method="post" action="/login">
        @csrf
        <div class="container">
            @if (session()->has('err'))
                      <div class="alert alert-danger">{{session('err')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">USER ID </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">Password </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class="row-mt-2">
                <div class="col-md-12">
                    <input type="submit" name="btn btn-primary" class="Login Now">
                </div>
            </div>
        </div>

    </form>
</body>
</html>
