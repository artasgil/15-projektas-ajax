@extends('layouts.app')

@section('content')

{{-- Jquery --}}
{{-- Galime netureti formos --}}

{{-- AJAX siunciama uzklausa turi vykdyti formos paskirti
    Tures veiksma - {{route("client.store")}}
    Tures metoda - POST
    --}}

{{-- <form action="{{route("client.store")}}" method = "POST">
    @csrf --}}
{{-- <input type = "text" name="clientName" />
<input type = "text" name="clientSurname" />
<textarea name="clientDescription" />  </textarea>

<button type = "submit">Add</button> --}}

{{-- </form> --}}



<input type = "text" name="clientName" id="clientName"/>
<input type = "text" name="clientSurname" id="clientSurname"/>
<textarea name="clientDescription" id="clientDescription"/>  </textarea>
<button type = "submit" id="add">Add</button>

<script>
    //Pasiimti reiksmes is laukeliu
    //Ivykdyti Ajax uzklausa
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });


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
                alert(data.success);
                //Cia galime gauti informacija is backendo, t.y. is controlerio return
                //data = $success_json
            }
        });

    });
</script>






@endsection
