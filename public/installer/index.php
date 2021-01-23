<?php
//require_once('../vendor/autoload.php');
$error = 0;
$errors = [];
if(file_exists( '../../.env')){
  $error = 1;
    $errors[] = ('Installation already complete. Please delete "/public/installer" directory');
}

if(!file_exists('../../vendor/autoload.php')){
    $error = 1;
    $errors[] = ('Please run "composer install && php artisan migrate" to install and update the db');
}

if($error == 1){
  foreach($errors as $err){
     echo '<br/>***'.$err;
  }
  die();
}
?>
<html>
<head>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  <style>
      .wizard {
          margin: 20px auto;
          background: #fff;
      }

      .wizard .nav-tabs {
          position: relative;
          margin: 40px auto;
          margin-bottom: 0;
          border-bottom-color: #e0e0e0;
      }

      .wizard > div.wizard-inner {
          position: relative;
      }

      .connecting-line {
          height: 2px;
          background: #e0e0e0;
          position: absolute;
          width: 80%;
          margin: 0 auto;
          left: 0;
          right: 0;
          top: 50%;
          z-index: 1;
      }

      .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
          color: #555555;
          cursor: default;
          border: 0;
          border-bottom-color: transparent;
      }

      span.round-tab {
          width: 70px;
          height: 70px;
          line-height: 70px;
          display: inline-block;
          border-radius: 100px;
          background: #fff;
          border: 2px solid #e0e0e0;
          z-index: 2;
          position: absolute;
          left: 0;
          text-align: center;
          font-size: 25px;
          padding-top: 19px;
      }
      span.round-tab i{
          color:#555555;
      }
      .wizard li.active span.round-tab {
          background: #fff;
          border: 2px solid #5bc0de;

      }
      .wizard li.active span.round-tab i{
          color: #5bc0de;
      }

      span.round-tab:hover {
          color: #333;
          border: 2px solid #333;
      }

      .wizard .nav-tabs > li {
          width: 25%;
      }

      .wizard li:after {
          content: " ";
          position: absolute;
          left: 46%;
          opacity: 0;
          margin: 0 auto;
          bottom: 0px;
          border: 5px solid transparent;
          border-bottom-color: #5bc0de;
          transition: 0.1s ease-in-out;
      }

      .wizard li.active:after {
          content: " ";
          position: absolute;
          left: 46%;
          opacity: 1;
          margin: 0 auto;
          bottom: 0px;
          border: 10px solid transparent;
          border-bottom-color: #5bc0de;
      }

      .wizard .nav-tabs > li a {
          width: 70px;
          height: 70px;
          margin: 20px auto;
          border-radius: 100%;
          padding: 0;
      }

      .wizard .nav-tabs > li a:hover {
          background: transparent;
      }

      .wizard .tab-pane {
          position: relative;
          padding-top: 50px;
      }

      .wizard h3 {
          margin-top: 0;
      }

      @media( max-width : 585px ) {

          .wizard {
              width: 90%;
              height: auto !important;
          }

          span.round-tab {
              font-size: 16px;
              width: 50px;
              height: 50px;
              line-height: 50px;
          }

          .wizard .nav-tabs > li a {
              width: 50px;
              height: 50px;
              line-height: 50px;
          }

          .wizard li.active:after {
              content: " ";
              position: absolute;
              left: 35%;
          }
      }
  </style>
  <script>
      $(document).ready(function () {
          //Initialize tooltips
          $('.nav-tabs > li a[title]').tooltip();

          //Wizard
          $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

              var $target = $(e.target);

              if ($target.parent().hasClass('disabled')) {
                  return false;
              }
          });

          $(".next-step").click(function (e) {

              var $active = $('.wizard .nav-tabs li.active');
              $active.next().removeClass('disabled');
              nextTab($active);

          });
          $(".prev-step").click(function (e) {

              var $active = $('.wizard .nav-tabs li.active');
              prevTab($active);

          });

          $('#check_db_connection').click(function(){
              $.ajax({
                  method: "POST",
                  url: "./db_check.php",
                  data: {
                      host: $('input[name ="db_host"]').val(),
                      user: $('input[name ="db_user"]').val(),
                      db: $('input[name ="db_name"]').val(),
                      port: $('input[name ="db_port"]').val(),
                      password: $('input[name ="db_password"]').val()
                  },
                  success: function (response) {
                      alert("Database connection success!!");
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                      let err = eval("(" + xhr.responseText + ")");
                      console.log('error is ',xhr.responseText)
                      alert(err.message);
                  }
              }).done(function( msg ) {
                  // alert( "Connection status: " + msg );
              });
          })


          $("#submit_all").click(function(event){
              var post_url = "./request.php?action=validate";

              var form_data = new FormData(document.getElementById('form_data'));
              form_data.append('site_logo', $('#site_logo')[0].files[0]);
              form_data.append('site_logo_small', $('#site_logo_small')[0].files[0]);

              $('#notifications').html('');
              // $('#submit_all').hide();
              $('#ajax_loading').show();

              $.ajax({
                  url : post_url,
                  type: 'POST',
                  data : form_data,
                  contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                  processData: false, // NEEDED, DON'T OMIT THIS
                  success: function (response) {
                      $('#notifications').append('<div class="alert alert-success">\n' +
                          '        <strong>Info!</strong> Installing...\n' +
                          '      </div>')

                      installScript();
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                      let err = eval("(" + xhr.responseText + ")");
                      console.log('err is ',err);
                      for (let key in err.message.data) {
                          $('#notifications').append('<div class="alert alert-warning">\n' +
                              '        <strong>Warning!</strong> '+err.message.data[key]+'.\n' +
                              '      </div>')
                      }
                      $('#submit_all').show();
                      $('#ajax_loading').hide();
                  }
              }).done(function(response){ //
                  // $("#server-results").html(response);
              });
          });

      });

      function installScript()
      {
          var post_url = "./request.php?action=install";
          $('#action').val('install');

          var form_data = new FormData(document.getElementById('form_data'));
          form_data.append('section', 'general');
          form_data.append('action', 'previewImg');
          form_data.append('site_logo', $('#site_logo')[0].files[0]);
          form_data.append('site_logo_small', $('#site_logo_small')[0].files[0]);

          // var request_method = $('#form_data').attr("method"); //get form GET/POST method
          // var form_data = $('#form_data').serialize(); //Encode form elements for submission

          $('#notifications').html('');

          $.ajax({
              url : post_url,
              type: 'POST',
              data : form_data,
              contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
              processData: false, // NEEDED, DON'T OMIT THIS
              success: function (response) {
                  $('#notifications').append('<div class="alert alert-success">\n' +
                      '        <strong>Info!</strong> Installation complete!!!</div>')

                  setTimeout(function(){
                      document.location.href="/index.php"
                  }, 3000);

                  $('#submit_all').show();
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  let err = eval("(" + xhr.responseText + ")");
                  console.log('err is ',err);
                  for (let key in err.message.data) {
                      $('#notifications').append('<div class="alert alert-warning">\n' +
                          '        <strong>Warning!</strong> '+err.message.data[key]+'.\n' +
                          '      </div>')
                  }
                  $('#submit_all').show();
                  $('#ajax_loading').hide();
              }
          }).done(function(response){ //
              // $("#server-results").html(response);
          });
      }

      function nextTab(elem) {
          $(elem).next().find('a[data-toggle="tab"]').click();
      }
      function prevTab(elem) {
          $(elem).prev().find('a[data-toggle="tab"]').click();
      }
  </script>
</head>
<body>
<div class="container">
  <div class="row">
    <div id="notifications">
<!--      <div class="alert alert-success">-->
<!--        <strong>Success!</strong> Indicates a successful or positive action.-->
<!--      </div>-->
<!---->
<!--      <div class="alert alert-info">-->
<!--        <strong>Info!</strong> Indicates a neutral informative change or action.-->
<!--      </div>-->
<!---->
<!--      <div class="alert alert-warning">-->
<!--        <strong>Warning!</strong> Indicates a warning that might need attention.-->
<!--      </div>-->
    </div>
    <section>
      <div class="wizard">
        <div class="wizard-inner">
          <div class="connecting-line"></div>
          <ul class="nav nav-tabs" role="tablist">

            <li role="presentation" class="active">
              <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-folder-open"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-compressed"></i>
                </span>
              </a>
            </li>
            <li role="presentation" class="disabled">
              <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-folder-close"></i>
                </span>
              </a>
            </li>

            <li role="presentation" class="disabled">
              <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                <span class="round-tab">
                  <i class="glyphicon glyphicon-ok"></i>
                </span>
              </a>
            </li>
          </ul>
        </div>

        <form role="form" name="form_data" id="form_data" method="post" enctype="multipart/form-data" >
          <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="step1">
              <h3>Site configurations</h3>
              <p>Site settings</p>
                <input type="hidden" name="action" id="action" value="validate">
                <div class="form-group">
                  <label for="exampleInputEmail1">Site name</label>
                  <input type="text" class="form-control" name="app_name" aria-describedby="emailHelp" placeholder="Site name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Site url</label>
                  <input type="text" class="form-control" name="app_url" placeholder="http://">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Site logo (1200px X 320px .png format) </label>
                  <input type="file" class="form-control" id="site_logo" name="site_logo" placeholder="Site logo">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Site logo(small) (1200px X 320px .png format)</label>
                  <input type="file" class="form-control" id="site_logo_small" name="site_logo_small" placeholder="Site logo(small)">
                </div>




              <div class="form-group">
                <label for="exampleInputEmail1">App mission</label>
                <input type="text" class="form-control" name="app_mission" aria-describedby="emailHelp" placeholder="App mission">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">App mission description</label>
                <textarea type="text" class="form-control" name="app_mission_description" aria-describedby="emailHelp" placeholder="App mission description"></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Guideline URL</label>
                <input type="text" class="form-control" name="guide_line_url" aria-describedby="emailHelp" placeholder="https://">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Terms of service</label>
                <input type="text" class="form-control" name="terms_of_service" aria-describedby="emailHelp" placeholder="https://">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Feedback URL</label>
                <input type="text" class="form-control" name="feedback" aria-describedby="emailHelp" placeholder="https://">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">App credit</label>
                <input type="text" class="form-control" name="app_credit" aria-describedby="emailHelp" placeholder="PRCPTION Travel, Inc.">
              </div>


              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="step2">
              <h3>Database</h3>
              <p>Db settings</p>

                <div class="form-group">
                  <label for="exampleInputEmail1">Host</label>
                  <input type="text" class="form-control" name="db_host" aria-describedby="emailHelp" placeholder="localhost">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="db_name" aria-describedby="emailHelp" placeholder="Db name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">User</label>
                  <input type="text" class="form-control" name="db_user" aria-describedby="emailHelp" placeholder="root">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Port</label>
                  <input type="text" class="form-control" name="db_port" aria-describedby="emailHelp" value="3306" placeholder="3306">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="text" class="form-control" name="db_password" aria-describedby="emailHelp" placeholder="Db password">
                </div>
                <button type="button" id="check_db_connection" class="btn btn-primary">Test connection</button>

              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="step3">
              <h3>Other settings</h3>
              <p>Google recaptcha settings</p>

                <div class="form-group">
                  <label for="exampleInputEmail1">Key</label>
                  <input type="text" class="form-control" name="google_recaptcha_key" aria-describedby="emailHelp" placeholder="Db host">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Secret</label>
                  <input type="text" class="form-control" name="google_recaptcha_secret" aria-describedby="emailHelp" placeholder="Db host">
                </div>

              <br/>
              <p>Outgoing email settings</p>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="outgoing_email_address" aria-describedby="emailHelp" placeholder="Outgoing email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="outgoing_email_name" aria-describedby="emailHelp" placeholder="Outgoing email name">
                </div>

              <br/>
              <p>Privacy policy settings</p>

                <div class="form-group">
                  <label for="exampleInputEmail1">External page URL</label>
                  <input type="email" class="form-control" name="privacy_policy_external_url" aria-describedby="emailHelp" placeholder="Http://someurl.com">
                </div>


              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
<!--                <li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
              </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="complete">
              <h3>Complete</h3>


              <p>Create Super Admin Account.</p>

              <div class="form-group">
                <label for="exampleInputEmail1">Admin Email</label>
                <input type="text" class="form-control" name="admin_email" aria-describedby="emailHelp" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Admin Password</label>
                <input type="password" class="form-control" name="admin_password" aria-describedby="emailHelp" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Retype Password</label>
                <input type="password" class="form-control" name="admin_password_confirm" aria-describedby="emailHelp" placeholder="Confirm password">
              </div>

              <br/>

              <p>Common terms.</p>

              <div class="form-group">
                <label for="exampleInputEmail1">Content</label>
                <input type="text" class="form-control" name="term_content" value="Video" aria-describedby="emailHelp" placeholder="Term name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">User</label>
                <input type="text" class="form-control" name="term_user" value="User" aria-describedby="emailHelp" placeholder="Term name">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Group</label>
                <input type="text" class="form-control" name="term_group" value="Group" aria-describedby="emailHelp" placeholder="Term name">
              </div>


              <ul class="list-inline pull-right">
                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                <!--                <li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                <li><button name="submit_all" id="submit_all" type="button" class="btn btn-primary btn-info-full next-step">Submit</button><img id="ajax_loading" style="display: none" src="/assets/front-theme/images/ajax-loader.gif" alt="" /></li>
              </ul>

            </div>
            <div class="clearfix"></div>

          </div>
        </form>
      </div>
    </section>
  </div>
</div>
</body>
</html>



