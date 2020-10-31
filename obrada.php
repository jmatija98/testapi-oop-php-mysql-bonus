<?php
    include "Database.php";
    $mydb = new Database('rest');
    if(isset($_POST["posalji"]) && $_POST["posalji"]="Posalji zahtev"){
        if($_POST["naslov_novosti"]!=null && $_POST["tekst_novosti"]!=null && $_POST["kategorija_odabir"]!=null){
            $niz = ["naslov"=> "'".$_POST["naslov_novosti"]."'", "tekst"=>"'".$_POST["tekst_novosti"]."'", "datumvreme"=>"NOW()", "kategorija_id"=>$_POST["kategorija_odabir"]];
            if($mydb->insert("novosti", "naslov, tekst, datumvreme, kategorija_id", $niz)){
                echo "vrednosti ubacene";
            }else{
                echo "vrednosti nisu ubacene";
            }
            $_POST = array();
            exit();
        }elseif($_POST["brisanje"]!=null && $_POST["odabir_tabele"]!=null){
            $tabela = $_POST["odabir_tabele"];
            $id = "id";
            $id_val = $_POST["brisanje"];
            if($mydb->delete($tabela,$id,$id_val)){
                echo "red obrisan";
            }else{
                echo "greska prilikom brisanja";
            }
            $_POST = array();
            exit();
        }elseif($_POST["kategorija_naziv"] != null) {
            $naziv = $_POST["kategorija_naziv"];
            if ($mydb->insert("kategorije", "naziv", [$naziv])) {
                echo "Uspesno ubacena kategorija";
            } else {
                echo "Neuspesno!";
            }
            $_POST = array();
            exit();
        
        } elseif($_POST["kategorija_naziv_put"] != null && $_POST["kategorija_id"] != null) {
            $naziv = $_POST["kategorija_naziv_put"];
            if ($mydb->update("kategorije", $_POST["kategorija_id"], "naziv", [$naziv])) {
                echo "Uspesno izmenjena kategorija!";
            } else {
                echo "Neuspesno!";
            }
            $_POST = array();
            exit();
        }

        elseif($_POST["kategorija_odabir_put"] != null && $_POST["novosti_id"] != null && $_POST["tekst_novosti_put"] != null &&  $_POST["naslov_novosti_put"] != null) {
            $niz = ["naslov"=> "'".$_POST["naslov_novosti_put"]."'", "tekst"=>"'".$_POST["tekst_novosti_put"]."'", "datumvreme"=>"NOW()", "kategorija_id"=>$_POST["kategorija_odabir_put"]];
            if ($mydb->update("novosti", "novosti_id", "naslov, tekst, datumvreme, kategorija_id", $niz)) {
                echo "Uspesno izmenjena novost";
            } else {
                echo "Neuspesno!";
            }
            $_POST = array();
            exit();

        } else {
            $tabela = $_POST["odabir_tabele"];
            if ($mydb->select($tabela, "*", null, null, null)) {
                echo "Uspesno prikazana tabela";
            } else {
                echo "Neuspesno!";
            }
        	$_POST = array();
        	exit();
        }


    }
?>