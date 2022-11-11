<!DOCTYPE html>

<html>

    <header>
        <script src="https://cdn.tailwindcss.com"></script>
    </header>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <body>

        <h2 class="mx-5 mt-5 font-black text-lg underline"> Register New Account: </h2>

        <form class="flex flex-col relative mx-5 mb-5 mt-2" action="attemptRegister" method="POST">
            @csrf
            <item class="my-2"> Username: <br> <input class="border-2" type="text" name="user" placeholder=" Type username"> </item>
            <item class="my-2"> Email: <br> <input class="border-2" type="text" name="email" placeholder=" Type Email Address"> </item>
            <item class="my-2"> Password: <br> <input class="border-2" type="password" name="pass" placeholder=" Type password"> </item>
            <item class="my-2"> Re-Type Password: <br> <input class="border-2" type="password" name="confPass" placeholder=" Confirm password"> </item>
            <item class="my-2"> Organization Name: <br> <input class="border-2" type="text" name="orgName" placeholder=" Type company Name"> </item>
            <item> <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Register"> </item>
        </form>

        <p class="mx-5"> {{session('redirectMsg')}} </p>

        @foreach ($errors->all() as $error)
            <li class="mx-5">{{ $error }}</li>
        @endforeach
        
    </body>

</html>