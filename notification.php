<?php  
	include_once 'assets/php/header.php';
?>
<div class="container">
  <div class="row justify-content-center my-2">
    <div class="col-lg-6 mt-4" id="showAllNotification">

    </div>
  </div>
</div>
<?php require_once 'assets/php/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function() {

  // Checking user is logedin or not
  $.ajax({
    url: 'assets/php/action.php',
    method: 'post',
    data: {
      action: 'checkUser'
    },
    success: function(response) {
      if (response === 'bye') {
        window.location = 'index.php';
      }
    }
  });

  fetchAllNotification();

  function fetchAllNotification() {
    $.ajax({
      url: 'assets/php/process.php',
      method: 'post',
      data: {
        action: 'fetchAllNotification'
      },
      success: function(response) {
        $("#showAllNotification").html(response);
      }
    });
  }

  checkNotification();

  function checkNotification() {
    $.ajax({
      url: 'assets/php/process.php',
      method: 'post',
      data: {
        action: 'notificationCheck'
      },
      success: function(response) {
        $("#showNotificationCheck").html(response);
      }
    });
  }

  //Delete notification
  $("body").on("click", ".close", function(e) {
    e.preventDefault();
    notification_id = $(this).attr('id');
    $.ajax({
      url: 'assets/php/process.php',
      method: 'post',
      data: {
        notification_id: notification_id
      },
      success: function(response) {
        fetchAllNotification();
        checkNotification();
      }
    });
  });


});
</script>
</body>

</html>
