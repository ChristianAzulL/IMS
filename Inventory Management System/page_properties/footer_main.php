<div class="offcanvas offcanvas-end settings-panel border-0" id="settings-offcanvas" tabindex="-1" aria-labelledby="settings-offcanvas">
  <div class="offcanvas-header settings-panel-header justify-content-between bg-shape" id="notif-header">
    <div class="z-1 py-1">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <h5 class="text-white mb-0 me-2">
          <span class="far fa-bell me-2 fs-9"></span>Notification
        </h5>
      </div>
    </div>
    <div class="z-1" data-bs-theme="dark">
      <button class="btn-close z-1 mt-0" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
  </div>

  <div class="offcanvas-body scrollbar-overlay px-x1 h-100" id="themeController">
    <div id="notification-area">
            <!-- Notifications content will be loaded here -->
    </div>
  </div>
</div>

<a class="card setting-toggle" href="#settings-offcanvas" data-bs-toggle="offcanvas">
  <div class="card-body d-flex align-items-center py-md-2 px-2 py-1">
    <div class="bg-primary-subtle position-relative rounded-start" style="height:34px;width:28px">
      <div class="settings-popover">
        <span class="ripple">
          <span class="fa-spin position-absolute all-0 d-flex flex-center">
            <span class="icon-spin position-absolute all-0 d-flex flex-center">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"/>
              </svg>
            </span>
          </span>
        </span>
      </div>
    </div>

    <small class="text-uppercase fw-bold py-2 pe-2 ps-1 rounded-end bg-primary-subtle" id="notif-text">notification</small>
  </div>
</a>



<!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
<script src="../vendors/popper/popper.min.js"></script>
<script src="../vendors/bootstrap/bootstrap.min.js"></script>
<script src="../vendors/anchorjs/anchor.min.js"></script>
<script src="../vendors/is/is.min.js"></script>
<script src="../vendors/glightbox/glightbox.min.js"></script>
<script src="../vendors/plyr/plyr.polyfilled.min.js"></script>
<script src="../vendors/fontawesome/all.min.js"></script>
<script src="../vendors/lodash/lodash.min.js"></script>
<script src="../vendors/list.js/list.min.js"></script>
<script src="../vendors/flatpickr/flatpickr.min.js"></script>
<script src="../vendors/flatpickr/bn.js"></script>
<script src="../assets/js/theme.js"></script>
<script src="../vendors/swiper/swiper-bundle.min.js"></script>
<script src="../vendors/choices/choices.min.js"></script>
<script src="../vendors/select2/select2.min.js"> </script>
<script src="../vendors/select2/select2.full.min.js"> </script>
<script src="../vendors/datatables.net/dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs5/dataTables.bootstrap5.min.js"> </script>
<script src="../vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js"> </script>

<script>
$(document).ready(function () {
    let previousUnreadCount = 0;
    let firstCheck = true;
    const notificationSound = document.getElementById('notification-sound');

    // Load notifications into the offcanvas on toggle
    $('a.setting-toggle').on('click', function () {
        $('#notification-area').load('../config/notifications.php', function(response, status, xhr) {
            if (status === "error") {
                console.error("❌ Failed to load notifications: " + xhr.status + " " + xhr.statusText);
            } else {
                console.log("✅ Notifications loaded successfully.");
            }
        });
    });

    function checkNotifications() {
        $.ajax({
            url: '../config/check_notification.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                const newUnreadCount = response.unread_count;

                if (newUnreadCount !== previousUnreadCount) {
                    console.log("🔄 Unread count changed: " + newUnreadCount);

                    // Play sound only if count increased and not the first check
                    if (!firstCheck && newUnreadCount > previousUnreadCount) {
                        notificationSound.play().catch(e => console.warn("🔇 Sound play failed:", e));
                    }

                    if (newUnreadCount > 0) {
                        $('#settings-offcanvas .offcanvas-header')
                            .addClass('bg-danger')
                            .removeClass('bg-shape');

                        $('.setting-toggle small').each(function () {
                            if ($(this).text().toLowerCase().includes("notification")) {
                                $(this).removeClass('bg-primary-subtle').addClass('bg-danger-subtle');
                            }
                        });
                    } else {
                        $('#settings-offcanvas .offcanvas-header')
                            .removeClass('bg-danger')
                            .addClass('bg-shape');

                        $('.setting-toggle small').each(function () {
                            if ($(this).text().toLowerCase().includes("notification")) {
                                $(this).removeClass('bg-danger-subtle').addClass('bg-primary-subtle');
                            }
                        });
                    }

                    previousUnreadCount = newUnreadCount;
                } else {
                    console.log("✅ No change in notification count.");
                }

                firstCheck = false;
            },
            error: function () {
                console.error("❌ Failed to check notifications.");
            }
        });
    }

    checkNotifications(); // Initial check
    setInterval(checkNotifications, 3000); // Check every 3 seconds
});
</script>
<!-- <script>
const authToken = "<?php //echo $_SESSION['auth_token']; ?>"; // from PHP session

let lastSentTime = 0;
const minInterval = 60000; // 60 seconds between logs

function sendActivityPing() {
    const now = Date.now();

    // Limit how often we send
    if (now - lastSentTime < minInterval) return;

    lastSentTime = now;

    fetch('../config/log_activity.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({ active: true })
    }).then(res => {
        if (res.ok) {
            console.log("Activity ping sent.");
        }
    }).catch(err => console.error("Error sending activity:", err));
}

// Trigger on any user interaction
['mousemove', 'click', 'keydown', 'scroll'].forEach(event =>
    window.addEventListener(event, sendActivityPing)
);
</script> -->

<!-- 
<script>
    // Disable right-click
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Disable common developer tool shortcuts, including F12 and variants
    document.addEventListener('keydown', function(e) {
        // Note: Fn+F12 typically triggers the same event as F12
        if (e.key === 'F12' || 
            (e.ctrlKey && e.shiftKey && ['I', 'C', 'J', 'U'].includes(e.key)) || 
            (e.ctrlKey && e.key === 'U')) {
            e.preventDefault();
        }
    });
</script>
 -->
