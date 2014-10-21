<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
     <link rel="stylesheet" href="/assets/css/login.css">
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <form class="form-signin" action="/Public/checkLogin" method="post">
        <h2 class="form-signin-heading">Email</h2>
        <input type="text" name="email" class="input-block-level" placeholder="Email address">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
<!--         <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label> -->
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>

    </div>
  </body>
</html>