<?php

    $conn = new mysqli('localhost', 'root', '', 'payrol');  
    if(!$conn->connect_error){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $kode = $_POST['id'];    
            $query = 'Select * From pegawai where kode_pegawai like "'.$kode.'"';
            $result = $conn->query($query);
            if($result->num_rows >0){
                $data = $result->fetch_assoc();
                $iddept = $data['id_departemen'];
                $idjab  = $data['id_jabatan'];
                $query2="Select departemen from departemen where departemen_id like '$iddept'";
                $res2=$conn->query($query2);
                if($res2->num_rows >0){
                    $dat2 = $res2->fetch_assoc();
                    $dept = $dat2['departemen'];
                } else{
                    $dept="unknown";
                }
                $query3 = "Select nama_jabatan from jabatan where id_jabatan like '$idjab'";
                $res3 = $conn->query($query3);
                if ($res3->num_rows > 0) {
                    $dat3 = $res3->fetch_assoc();
                    $jab = $dat3['nama_jabatan'];
                } else {
                    $jab = "unknown";
                }
                $array = array();
                $array['dept'] = $dept;
                $array['jab'] = $jab;
                echo json_encode($array);           
            } else{
                echo'no data';
            }
        } else{
            echo 'It is not post';
        }
    } else{
        echo'failed to connect to server '.$conn->error; 
    }


?>