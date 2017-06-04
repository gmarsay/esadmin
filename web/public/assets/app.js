/**
 * ES Admin
 */

/* Realtime interface */
$(document).ready(function() {
  update_header_left(5000);
});

function update_header_left(refresh=2000) {
  $.get(
    'api.php?api=partials/header-stats',
    function success(data) {
      $('#header-info').html(data);
    }
  );

  setTimeout(update_header_left, refresh);
}
