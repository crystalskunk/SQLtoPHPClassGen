<?php
	require_once("LoadClass.php");
	$pdo = Database::getInstance();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<form action="" method="POST" name="frmtest">
	<select name="numclient" id="numclient">
	</select>
	<select name="action">
		<option value="update">update</option>
		<option value="insert">insert</option>
		<option value="delete">delete</option>
		<option value="select">select</option>
	</select>
	<br>
    <input type="text" name="nom" id="nomclient">
    <br>
    <input type="text" name="prenom" id="prenom">
    <br>
    <input type="text" name="telephone" id="telephone">
    <br>
    <input type="text" name="email" id="email">
    <br>
    <input type="text" name="adresse" id="adresse">
    <br>
    <input type="text" name="npa" id="npa">
    <br>
    <input type="text" name="localite" id="localite">
    <br>
    <input type="button" class="switch-test" name="s1" value="call ajax">
    <!--input type="hidden" name="token" value="f4f4f99191ca681c2abe4e9cf07843b5"-->
</form>
<div id="logjs" name="logjs"></div>
<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
		type: "POST",
        dataType: 'json',
        data: {
			'action': 'loadClients'
        },
		dataType: 'json',
		url: './call_client.php', 
		success: function(data) {
			$.each(data, function(key, value) {
				$('#numclient')
				.append($('<option>', { value: value.idclient })
				.text(value.nom));
			});
		}
	});
	$('#numclient').change(function() {
        var selectedValue = $(this).val();
        $.ajax({
            type: "POST",
            url: "./call_client.php",
            data: {idclient: selectedValue, action: 'select'},
            dataType: "json",
            success: function(response) {
                $("input[name='nom']").val(response.nom);
				$("input[name='prenom']").val(response.prenom);
				$("input[name='telephone']").val(response.telephone);
				$("input[name='email']").val(response.email);
				$("input[name='adresse']").val(response.adresse);
				$("input[name='npa']").val(response.npa);
				$("input[name='localite']").val(response.localite);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " : " + errorThrown);
            }
        });
    });
});
$(document).on('click', '.switch-test', function(e) {
    e.preventDefault();
    var idclient = $("select[name='numclient']").val(),
        nom = $("input[name='nom']").val(),
        prenom = $("input[name='prenom']").val(),
        telephone = $("input[name='telephone']").val(),
        email = $("input[name='email']").val(),
        adresse = $("input[name='adresse']").val(),
        npa = $("input[name='npa']").val(),
        localite = $("input[name='localite']").val(),
        action = $("select[name='action']").val();
    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            'idclient': idclient,
            'nom': nom,
            'prenom': prenom,
            'telephone': telephone,
            'email': email,
            'adresse': adresse,
            'npa': npa,
            'localite': localite,
			'action': action
        },
        url: './call_client.php',
        success: function(response) {
			$("input[name='nom']").val(response.nom);
			$("input[name='prenom']").val(response.prenom);
			$("input[name='telephone']").val(response.telephone);
			$("input[name='email']").val(response.email);
			$("input[name='adresse']").val(response.adresse);
			$("input[name='npa']").val(response.npa);
			$("input[name='localite']").val(response.localite);
			if(action=='delete'||action=='insert'){
				$.ajax({
					type: "POST",
					dataType: 'json',
					data: {
						'action': 'loadClients'
					},
					dataType: 'json',
					url: './call_client.php', 
					success: function(data) {
						$('#numclient').empty();
						$.each(data, function(key, value) {
							$('#numclient')
							.append($('<option>', { value: value.idclient })
							.text(value.nom));
						});
					}
				});
			}
            $('#logjs').html(action + ' Fait !');
        },
		error: function(jqXHR, textStatus, errorThrown) {
			$('#logjs').append('<br />Error: ' + textStatus + ' : ' + errorThrown);
		},
		complete: function(jqXHR, textStatus) {
			$('#logjs').append("<br />Request completed with status: " + textStatus);
		}
    });
});
</script>