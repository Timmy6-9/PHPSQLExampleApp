<!DOCTYPE html>

<html>

    <header>
        <script src="https://cdn.tailwindcss.com"></script>
    </header>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <body>

        <form class="relative flex flex-col ml-8 my-8 w-50 items-start float-left" action="submitNewClient" method="post">
            @csrf

            <h2>New Client Name:</h2>
            <input class="border-2" type="text" name="companyName">
            <br>
            <h2>New Main Contact Name:</h2>
            <input class="border-2" type="text" name="contactName">
            <br>
            <h2>New Contact Phone Number:</h2>
            <input class="border-2" type="text" name="phoneNumber">
            <br>
            <h2>New Client Email:</h2>
            <input class="border-2" type="text" name="emailAddress">
            <br>
            <h2>New Client Address:</h2>
            <input class="border-2" type="text" name="companyAddress">
            <br>
            <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Add Customer">  <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Cancel" formaction="login">
        
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