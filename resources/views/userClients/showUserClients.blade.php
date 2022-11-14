<!DOCTYPE html>

<html>

    <header>

        <script src="https://cdn.tailwindcss.com"></script>

        <script>
            function changeClient(customerName, mainContact, customerPhone, customerEmail, customerAddress, customerID){
                document.getElementById("cn").innerHTML = customerName;
                document.getElementById("mcn").innerHTML = mainContact;
                document.getElementById("cpn").innerHTML = customerPhone;
                document.getElementById("ce").innerHTML = customerEmail;
                document.getElementById("ca").innerHTML = customerAddress;
                document.getElementById("cid").value = customerID;
            }
        </script>

    </header>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <body>

        
        
        <sidebar class="flex flex-col my-1 items-start float-left">

            @if(!empty($clientDetails))
                @foreach ($clientDetails as $row)
                    <!-- Can't seem to find a way to output this to javascript as one object/array or as a json string. -->
                    <button onclick="changeClient('<?php echo addslashes($row->CustomerName)?>', '<?php echo $row->MainContactName?>', '<?php echo $row->MainContactPhone?>', '<?php echo $row->CustomerEmail?>', '<?php echo $row->CustomerAddress?>', '<?php echo $row->id?>')" class="border-2 border-gray-400 my-2 mx-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50"> {{$row->CustomerName}} </button>
                @endforeach
            @endif

            <form class="border-2 border-gray-400 my-2 mx-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" action="addClient" method="post">@csrf<input type="submit" value="Add New Customer"></form>

        </sidebar>

        @if(!empty($clientDetails))

            <div class="relative flex flex-col my-8 left-10">
                
                <h2>Client Name</h2>
                <h3 id="cn">{{$clientDetails[0]->CustomerName}}</h3>
                <br>
                <h2>Main Contact</h2>
                <h3 id="mcn">{{$clientDetails[0]->MainContactName}}</h3>
                <br>
                <h2>Contact Phone Number</h2>
                <h3 id="cpn">{{$clientDetails[0]->MainContactPhone}}</h3>
                <br>
                <h2>Client Email</h2>
                <h3 id="ce">{{$clientDetails[0]->CustomerEmail}}</h3>
                <br>
                <h2>Client Address</h2>
                <h3 id="ca">{{$clientDetails[0]->CustomerAddress}}</h3>
                <br>
                <form action="changeClient" method="post">
                    @csrf
                    <input type="hidden" id="cid" name="clientID" value={{$clientDetails[0]->id}} />
                    <input class="border-2 border-gray-400 mt-4 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Edit Details">
                    <br>
                    <input class="border-2 border-gray-400 my-2 px-2 rounded-md bg-slate-200 hover:bg-slate-100 active:bg-slate-50" type="submit" value="Delete Client" formaction="removeClient">
                </form>

            </div>

        @endif

        <p class="mx-5"> {{session('redirectMsg')}} </p>

    </body>

    <style>
        h2{
            text-decoration: underline 10%;
            font-weight: bold;
            margin-top: 0.5%;
        }
    </style>

</html>