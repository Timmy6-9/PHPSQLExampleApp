<!DOCTYPE html>

<html>

    <header>
        <script src="https://cdn.tailwindcss.com"></script>
    </header>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <body>

        <form class="relative mx-8 my-8 w-50 items-start float-left" action="clientDeleted" method="post">
        @csrf
        <h1 class="bold">Really delete {{$clientToDelete->CustomerName}}?</h1>
        <input type="hidden" value={{htmlspecialchars($clientToDelete->id)}} name="companyID">
        <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Yes"> <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="No" formaction="login">
        
        </form>

    </body>

    <style>
        h2{
            text-decoration: underline 10%;
            font-weight: bold;
            margin-top: 0.5%;
        }
    </style>

</html>