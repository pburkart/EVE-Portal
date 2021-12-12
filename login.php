<?php
  require "core/settings.php";
  require_once "includes/header.php";
  if(isset($_SESSION['id'])){
    header("Location: index.php");
    die();
  } else {
    $URL = "https://login.eveonline.com/v2/oauth/authorize/" . "?response_type=code&redirect_uri=" . $CALLBACK . "&client_id=" . $CLIENT_ID . "&scope=" . $SCOPES . "&state=" . $STATE;
  }
?>

      <main class="">
        <div class="row">
          <div class="form-parent">
            <div class="col s12 center-align">
              <div class="row">
                Login with your EVE Online Account
              </div>
              <div class="row">
                <a href="<?php echo $URL; ?>"><img src="images/login.png"></a>
              </div>
            </div>
          </div>
        </div>
      </main>

<?php
  require_once "includes/footer.php";
?>
