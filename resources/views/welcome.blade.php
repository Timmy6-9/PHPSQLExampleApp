<!DOCTYPE html>

<html>

    <header>
        <script src="https://cdn.tailwindcss.com"></script>
    </header>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <body>

        <h2 class="mx-5 mt-5 font-black text-lg underline"> Please Login: </h2>

        <form class="flex flex-col relative mx-5 mb-5 mt-2" action="login" method="POST">
            @csrf
            <item class="my-2"> Username: <br> <input class="border-2" type="text" name="user" placeholder=" Type username"> </item>
            <item class="my-2"> Password: <br> <input class="border-2" type="password" name="pass" placeholder=" Type password"> </item>
            <item> <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Login"> </item>
            <item> <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Register New Account" formaction="newUser"> </item>
        </form>

        <p class="mx-5"> {{session('redirectMsg')}} </p>

        @foreach ($errors->all() as $error)
            <li class="mx-5">{{ $error }}</li>
        @endforeach
        
    </body>

</html>