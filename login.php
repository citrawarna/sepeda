
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/logo-sepeda.png">

    <title>Login - Koperasi Error Logic</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center bg-warning">

    <form class="form-signin" action="proses/login.php" method="post">
      <img class="mb-4 border-logo" src="img/logo-sepeda.png" alt="" width="200"  >
      <h1 class="h3 mb-3 font-weight-normal white">Website Rental Sepeda</h1>
         <?= msghandling(); ?>
      <label class="sr-only">Username</label>
      <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
      <label  class="sr-only">Password</label>
      <input type="password" class="form-control" placeholder="Password" name="password" required>
      <div class="checkbox mb-3">
        <label class="white">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <input type="submit" class="btn btn-lg btn-secondary btn-block" value="Sign in">
      <p class="mt-5 mb-3 white">&copy; 2018 - by Refo Junior</p>
    </form>
  </body>
</html>
