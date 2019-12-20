jQuery(document).ready(function() {
  AOS.init({
    duration: 1200,
  });
  jQuery('.mobile-menu .mobile').on('click', function() {
    jQuery('.topnav').toggle('slow');
  });

  jQuery('.closebtn').on('click', function() {
    jQuery('.topnav').hide();
  });
});
