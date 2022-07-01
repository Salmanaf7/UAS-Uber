<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="./css.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="./slide.js"></script>
</head>
<body>
<h3 align="center" > Booking Order Uber Apps </h3>
<h5 align="center" >copyright &copy; 2022 by Salman Alfarisi - 1202912004</h5>

<form action ="" method="post">
    <table class="center">
         <tr>
            <td width="200">Email</td>
            <td><input type="text" name="emailCs"></td>
        </tr>
        <tr>
            <td width="130">No Hp Customer</td>
            <td><input type="text" name="mobileCs"></td>
        </tr>
        <tr>
            <td width="130">No Hp Driver</td>
            <td><input type="text" name="mobileDr"></td>
        </tr>
        <tr>
            <td width="130">ID Customer</td>
            <td><input type="text" name="id"></td>
        </tr>
        <tr>
            <td width="130">Nama Customer</td>
            <td><input type="text" name="customer"></td>
        </tr>
        <tr>
            <td width="130">Nama Driver</td>
            <td><input type="text" name="driver"></td>
        </tr>
        <tr>
            <td width="130">Pickup location</td>
            <td><input type="text" name="pickup"></td>
        </tr>
        <tr>
            <td width="130">Destination</td>
            <td><input type="text" name="destination"></td>
        </tr>
        <tr>
            <td width="130">Kilometer</td>
            <td><div class="slidecontainer">
            <input type="range" min="1" max="50" class="slider" id="myRange" name="kilometer"></div></td>
        </tr>
        <div>
          <tr>
              <td><label>Metode Pembayaran</label></td>
                <td>
                  <select id="selecting" input type="text" name="payment">
                  <option placeholder="Pilih status"></option>
                  <option value="Cash" >Cash</option>
                  <option value="Transfer">Transfer</option>
                </select></td>
            </tr>
            <tr class="Transfer box">
              <td width="130">No Rekening</td>
              <td><input type="text" name="noRek"></td>
          </tr>
          <tr class="Transfer box">
                <td style="text-color: black;"><label>Pilih Bank</label></td>
                <td><select input type="text" name="bank" >
                  <option placeholder="Pilih status"></option>
                  <option value="BCA" >BCA</option>
                  <option value="BNI">BNI</option>
                </select></td>
          </tr>
          <tr class="Cash box">
                <td></td>
          </tr>
       </div>
        <tr>
            <td><label>Status Pembayaran</label></td>
              <td><select input type="text" name="statusPayment">
                <option placeholder="Pilih status"></option>
                <option value="lunas" >Lunas</option>
                <option value="belum lunas">Belum Lunas</option>
              </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Book" name="proses"></td>
        </tr>

    </form>
  </body>
</html>

<?php 

include "koneksi.php";

if(isset($_POST['proses'])){
    
    mysqli_query($koneksi, "insert into users set
        idUser = '$_POST[id]', 
        customer = '$_POST[customer]',
        driver = '$_POST[driver]', 
        pickup = '$_POST[pickup]', 
        destination = '$_POST[destination]', 
        kilometer = '$_POST[kilometer]', 
        payment = '$_POST[payment]', 
        bank = '$_POST[bank]', 
        noRek = '$_POST[noRek]', 
        statusPayment = '$_POST[statusPayment]'"); 
       
        echo "Berhasil Melakukan Booking Order";

$km = $_POST['kilometer'];
$driver = $_POST['driver'];
$customer = $_POST['customer'];
$waktu = $km*5;
$harga = $km*6500;
$mobile = $_POST['mobileCs'];
$email = $_POST['emailCs'];
$mobile2 = $_POST['mobileDr'];
$namabank = $_POST['bank'] ? $_POST['bank'] : 0 ;
$norek = $_POST['noRek'] ?  $_POST['noRek'] : 0;

        mysqli_query($koneksi, "insert into trip set
        jarak = '$km', 
        waktu = '$waktu', 
        harga = '$harga', 
        pickup = '$_POST[pickup]', 
        destination = '$_POST[destination]'"); 

        mysqli_query($koneksi, "insert into driver set
        driver = '$driver', 
        mobile = '$mobile2'");   
        
        mysqli_query($koneksi, "insert into customer set
        customer = '$customer', 
        email = '$email', 
        mobile ='$mobile'");   

        mysqli_query($koneksi, "insert into pembayaran set
        namaPembayaran = '$_POST[payment]'"); 

        mysqli_query($koneksi, "insert into bank set
        namaBank = '$namabank'");
        
        mysqli_query($koneksi, "insert into statusPayment set
        namaStatus = '$_POST[statusPayment]'");

        mysqli_query($koneksi, "insert into transfer set
        noRek = '$norek'");
      }

?>

<script>
  $(document).ready(function(){
    $("#selecting").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
});

</script>