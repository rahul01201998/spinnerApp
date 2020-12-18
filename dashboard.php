<?php

ini_set('display_errors', 0);
error_reporting(0);

require_once("includes/SiteSetting.php");
require_once("includes/classes/class.common.php");

session_start();

if($_SESSION['valid'] != 'true'){
  // $comObj->redirectpg('index.php');
  header("Location: index.php"); 
  exit;
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 
<title>Spin to win</title>
<meta name="description" content=" "/>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-6"><h5 class="col align-left" style="color: cyan;">Welcome <?= ucwords($_SESSION['SessAdminName']); ?></h5></div>
      <div class="col-md-6"><h5 class="text-right" style="color: cyan;"><a href="logout.php">Logout</a></h5></div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="col text-center">
      <h3 style="color: cyan; font-weight: bold; font-style: italic;">SPIN TO WIN</h3>
    </div>
  </div>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-4" id="rand" ><img style="border-radius: 10px;box-shadow: 5px 2px 7px 4px white;" src="img/user.png"></div>
    <div class="col-md-4" id="rand2"><img style="border-radius: 10px;box-shadow: 5px 2px 7px 4px white;" src="img/user.png"></div>
    <div class="col-md-4" id="rand3" ><img style="border-radius: 10px;box-shadow: 5px 2px 7px 4px white;" src="img/user.png"></div>
  </div>
</div>
<div class="row mt-5">
    <div class="col text-center">
      <input type="hidden" name="count" id="count" value="0">
      <div id="demo" style="color: cyan; font-style: italic;"></div><br>
       <button type="button" class="btn btn-secondary common_click">Spin Now</button>
    </div>
 </div>

 <div class="container mt-2">
   <h5 style="color: cyan">Use Points to redeem following products...</h5>
   <div class="row mt-3">
    <div class="col-md-4">
      <h6 style="color: white">Points Required 100</h6>
      <p style="color: white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <button type="button" class="btn btn-secondary" id="one" disabled>Redeem</button>
    </div>
    <div class="col-md-4">
      <h6 style="color: white">Points Required 200</h6>
      <p style="color: white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <button type="button" class="btn btn-secondary" id="two" disabled>Redeem</button>
    </div>
    <div class="col-md-4">
      <h6 style="color: white">Points Required 500</h6>
      <p style="color: white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      <button type="button" class="btn btn-secondary" id="five" disabled>Redeem</button>
    </div>
  </div>
 </div>

</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  
//Math.floor((Math.random() * 900) + 400)

function myFunction1(arr1,emp_name1) {
    var lastindex1 = arr1.length - 1;
    // var second_last = arr.length - 2;
    // var third_last = arr.length - 3;
    
    var count = 0;
    // first run
     $.each(arr1, function(index, value) {

      var timer = Math.floor((Math.random() * 700) + 230);

      if(index == lastindex1){
        timer = 1000;
         setTimeout(function() {

           // $('#append_'+ gift_no).html(gift_no +") "+emp_name); 

          }, count * timer + 50)
      }
      setTimeout(function() {
       // $("#rand").html(value);
       $("#rand").html("<img style='border-radius: 10px;box-shadow: 5px 2px 7px 4px white;' src="+value+">");

      }, count * timer)
      count++;
    });

}

function myFunction2(arr2,emp_name2) {
    var lastindex2 = arr2.length - 1;
    // var second_last = arr.length - 2;
    // var third_last = arr.length - 3;
    
    var count = 0;
    // first run
     $.each(arr2, function(index, value) {

      var timer = Math.floor((Math.random() * 700) + 230);

      if(index == lastindex2){
        timer = 1000;
         setTimeout(function() {

           // $('#append_'+ gift_no).html(gift_no +") "+emp_name); 

          }, count * timer + 50)

      }

      setTimeout(function() {

       // $("#rand").html(value);
       $("#rand2").html("<img style='border-radius: 10px;box-shadow: 5px 2px 7px 4px white;' src="+value+">");

      }, count * timer)
      count++;
    });

}

function myFunction3(arr3,emp_name3,msg) {

    var lastindex3 = arr3.length - 1;
    // var second_last = arr.length - 2;
    // var third_last = arr.length - 3; 
    
    var count = 0;
    // first run
     $.each(arr3, function(index, value) {

      var timer = Math.floor((Math.random() * 700) + 230);

      if(index == lastindex3){
        timer = 1000;
         setTimeout(function() {
          swal(msg);
          // alert(msg);
           // $('#append_'+ gift_no).html(gift_no +") "+emp_name); 

          }, count * timer + 50)
      }
      setTimeout(function() {
       // $("#rand").html(value);
       $("#rand3").html("<img style='border-radius: 10px;box-shadow: 5px 2px 7px 4px white;' src="+value+">");
      }, count * timer)
      count++;
    });     
}

function setTime(){
  var dt = new Date();
        var nn =  dt.setMinutes( dt.getMinutes() + 30);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = nn - now;

  // Time calculations for minutes and seconds
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = "Please try after " + minutes + ":" + seconds + " minutes";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    $('.common_click').prop('disabled',false);
    $('#count').val(0);
    location.reload();
    <?php unset($_SESSION['click']); ?>
     document.getElementById("demo").innerHTML = "";
  }
}, 1000);
}

$('.common_click').on('click',function(e){
            e.preventDefault();
                var count = $('#count').val();
                count++;
                $('#count').val(count);
                // count++;
            $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    data: {num:count},
                    url: 'fetching.php',
                    success: function (data) {
                        if(data.status == 'success'){
                          // alert(data.img_set_1);
                          var points_msg;
                        if (data.points == 'two_hundred'){
                          points_msg = "Congratulations You get 200 points. Use this to redeem below products.";
                          $('#two').prop('disabled',false);
                        }else if(data.points == 'five_hundred'){
                          $('#five').prop('disabled',false);
                          points_msg = "Congratulations You get 500 points. Use this to redeem below products.";
                        }else{
                          points_msg = "That Was Great Spin! One more try might make you lucky. To earn more spins click below.";
                        }
                         myFunction1(data.img_set_1,data.img_name_1);
                         myFunction2(data.img_set_2,data.img_name_2);
                         myFunction3(data.img_set_3,data.img_name_3,points_msg);
                         // return false;
                        }
                        if (data.status == 'disable') {
                          $('.common_click').prop('disabled',true);
                          setTime();
                        }
                        
                    }
             });
});
</script>

</html>