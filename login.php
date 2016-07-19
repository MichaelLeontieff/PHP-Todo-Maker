<?php include_once('libs/login_users.php'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Todo Maker</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#show_register").click(function() {
                   $(".login_form").hide();
                    $(".register_form").show();
                    return false;
                });

                $("#show_login").click(function() {
                    $(".login_form").show();
                    $(".register_form").hide();
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div id="mainWrapper">
            <div class="navbar-default" role="navigation">
                <div class="container-fluid">
                    <a class="navbar-brand">Todo List</a>
                    <div class="navbar-text navbar-right">A simple @todo organiser created with PHP and Bootstrap</div>
                </div>
            </div><!-- end navbar -->



            <div class="container">
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
                ?>

                <div class="login_form">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            <form method="post" action="login.php" role="form" class="form">
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="login_username" id="username" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="login_password" id="password" class="form-control"/>
                                </div>

                                <div class="form_elements">
                                    <input type="submit" name="login" id="login" class="btn btn-success" value="Login"/>
                                    <a href="" id="show_register" class="btn btn-default">Register</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="register_form">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registration</div>
                        <div class="panel-body">

                            <form method="post" action="login.php" role="form" class="form">
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="repassword">Re-Enter Password</label>
                                    <input type="password" name="repassword" id="repassword" class="form-control"/>
                                </div>

                                <div class="form_elements">
                                    <input type="submit" name="register" id="register" class="btn btn-success" />
                                    <a href="" id="show_login" class="btn btn-default">Have an Account?</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div><!-- end content -->
        </div>
    </body>
</html>