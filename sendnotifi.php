<?php 
  require 'include/header.php';
  ?>
  <body data-col="2-columns" class=" 2-columns ">
      <div class="layer"></div>
        <div class="wrapper">
      <?php include('main.php'); ?>

        <div class="main-panel">
            <div class="main-content">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Enviar Notificación</h4>
                                </div>
                                <div class="card-body" style="padding:10px;">
                                    <div class="row" matchheight="card">
                                        <div class=" col-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <form class="form" id="send">
                                                        <input type="hidden" name="send" value="true">
                                                    <div class="form-body">

                                                        <div class="form-group">
                                                            <input class="form-control"  name="title" type="text" id="input" placeholder="(Titulo) - max. 50 carácter" maxlength="50" required>
                                                        </div>
                                                        <div class="form-group" >
                                                            <textarea class="form-control" name="content" id="" cols="30" rows="5" placeholder="(Contenido) - max. 125 carácter" maxlength="125" required></textarea>
                                                        </div>
                                                        <div class="form-group" style="display: none;">
                                                            <input class="form-control" name="url" type="text" id="input" placeholder="URL">
                                                        </div>
                                                        <div class="form-group" >
                                                            <button type="submit" id="sendnotifi" class="btn btn-raised btn-raised btn-primary">Enviar</button>
                                                            <br><i id="result">
                                                            </i>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <style>
        .col-xl-3.col-lg-6.col-12 > .card {
    background: aliceblue;
}
        
    </style>

   <?php 
  require 'include/js.php';
  ?>
            <script>
                $('#send').on("submit", function() {
                    var sent = $(this).serialize();
                    console.log(sent);
                    $.ajax({
                        type: "POST",
                        url: "./api/notification_api.php",
                        data: sent,
                        dataType: "json",
                        beforeSend: function() {
                            $(':input[type="submit"]').prop('disabled', true);
                            $(':input[type="submit"]').fadeIn().html('Enviando <i class="fa fa-spinner fa-spin hidespin"></i>');
                            $('.hidespin').fadeIn().css('display', 'inherit');
                        },
                        success: function(result) {
                            $(':input[type="submit"]').prop('disabled', false);
                            $('.hidespin').css('display', 'none');
                            $(':input[type="submit"]').fadeIn().html('Enviar');
                            //$('#result').html("Notification sent to <strong>"+result+"</strong> devices!").fadeIn();
                            $('#result').html('<div class="alert alert-success" role="alert">Notificacion enviada a '+ result +' Dispositivos </div>');
                        }

                    });
                    return false;
                });

            </script>
 
  </body>


</html>