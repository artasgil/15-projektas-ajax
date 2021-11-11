@extends('layouts.app')


@section('content')
<div class="container">
    <div class="ajaxForm">
        <div class="form-group row">
            <label for="clientName" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        <input class="form-control col-md-4"  type = "text" name="clientName" id="clientName"/>
        </div>
        <div class="form-group row">
            <label for="clientSurname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
        <input class="form-control col-md-4" type = "text" name="clientSurname" id="clientSurname"/>
        </div>
        <div class="form-group row">
            <label for="clientDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
        <textarea class="form-control col-md-4" name="clientDescription" id="clientDescription"/>  </textarea>
        </div>
        <div class="form-group row col-md-4">
        <button class= "btn btn-primary" type = "submit" id="add">Add</button>
        <button class= "btn btn-danger" type = "dummyAdd" id="add">Dummy Add</button>

        </div>

    </div>

    <a href="{{route('client.create')}}" class="btn btn-success">Add client</a>


    <table id="clients" class="table table-striped">

    <tr>
        <th> ID </th>
        <th>Name</th>
        <th> Surname </th>
        <th> Description </th>
        <th> Action </th>
    </tr>

    @foreach ($clients as $client)
    <tr class="client">
        <td>{{$client->id}} </td>
        <td>{{$client->name}} </td>
        <td>{{$client->surname}} </td>
        <td>{!! $client->description !!} </td>
        <td>
            <form method="post" action={{route('client.destroy',[$client])}}>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>

            <button class="btn btn-success delete" data-clientid = "{{$client->id}}">DELETE AJAX</button>

        </td>
    </tr>
    @endforeach

    </table>
</div>

{{-- Add funkcija --}}
<script>
    //Pasiimti reiksmes is laukeliu
    //Ivykdyti Ajax uzklausa
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $("#dummyAdd").click(function() {
    //     //Pasirinksime lentele ir i jos vidu idesime <tr> zyme, visa eilute
    //     // su stulpeliais

    //     $("#clients").append("<tr><td>jj</td><td>jj</td><td>jj</td><td>jj</td><td>jj</td></tr>");
    // });

    $("#add").click(function() {
        var clientName = $("#clientName").val();
        var clientSurname = $("#clientSurname").val();
        var clientDescription = $("#clientDescription").val();

        //javascript masyvas - json
        //sugeba suprasti tik json formata

        $.ajax({
            type: 'POST',
            url: '{{route("client.store")}}',
            data: {clientName: clientName,  clientSurname: clientSurname, clientDescription: clientDescription },
            success: function(data) {



                $("#clients").append('<tr><td>'+data.clientID+'</td><td>'+data.clientName+'</td><td>'+data.clientSurname+'</td><td>'+data.clientDescription+'</td><td><form method="post" action={{route("client.destroy",[$client])}}>@csrf<button type="submit" class="btn btn-danger">DELETE</button></form><button class="btn btn-success delete" data-clientid = "{{$client->id}}">DELETE AJAX</button></td></tr>');
                alert(data.success);
                //Cia galime gauti informacija is backendo, t.y. is controlerio return
                //data = $success_json
            }
        });
    });
</script>



{{-- Delete funkcija --}}
<script>
    //Pasiimti reiksmes is laukeliu
    //Ivykdyti Ajax uzklausa
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".delete").click(function() {

                $(this).parents('.client').remove();

        console.log($(this).attr("data-clientid"));

        $.ajax({
            type: 'POST',
            url: '/client/destroy/' + $(this).attr("data-clientid"),
            success: function(data) {
                alert("Deleted");
                //Cia galime gauti informacija is backendo, t.y. is controlerio return
                //data = $success_json
            }
        });
    });
</script>





{{-- DESTYTOJO KODAS --}}
{{-- <script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".delete").click(function() {
        $(this).parents('.client').remove();
        console.log($(this).attr("data-clientid"));
        $.ajax({
            type: 'POST',
            url: '/client/destroy/' + $(this).attr("data-clientid"),
            success: function(data) {
                alert("Deleted");
            }
        });
    })
    $("#add").click(function() {
        var clientName = $("#clientName").val();
        var clientSurname = $("#clientSurname").val();
        var clientDescription = $("#clientDescription").val();

        $.ajax({
            type: 'POST',
            url: '{{route("client.store")}}',
            data: {clientName: clientName, clientSurname: clientSurname, clientDescription: clientDescription  },
            success: function(data) {
                $("#clients").append("<tr><td>"+data.clientID+"</td><td>"+data.clientName+"</td><td>"+data.clientSurname+"</td><td>"+data.clientDescription+"</td></tr>")
                alert(data.message);

            }
        });
        // console.log(clientName + " " + clientSurname + " " + clientDescription);
    });

</script> --}}




@endsection
