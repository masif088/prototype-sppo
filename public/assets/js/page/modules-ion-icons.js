"use strict";

$("#icons li").each(function() {
  $(this).append('<div manager-class="icon-name">'+ $(this).attr('class') +'</div>');
});
$("#icons li").click(function() {
  $(".icon-name").fadeOut();
  $(this).find('.icon-name').fadeIn();
});
