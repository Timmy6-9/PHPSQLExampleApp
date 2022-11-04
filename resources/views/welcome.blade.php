<!DOCTYPE html>

<html>
    <meta name="viewport">

    <body>
        <h2> Please Login: </h2>

        <form action="tableAccess" method="POST">
        @csrf
            <h3> Username: </h3> <input type="text" name="user"><br>
            <h3> Password: </h3> <input type="password" name="pass"><br>
            <input type="submit" value="Login">
        </form>
    </body>

    <style>
        h2{
            text-decoration: underline;
        }
    </style>

</html>
