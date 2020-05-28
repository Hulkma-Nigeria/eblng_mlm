//import { log } from "util";

$(window).on('load', function () {
  background();

  //Set header or csrf token transportation via jqury ajax
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });

  $.ajax('/user/cart-count')
    .then(res => updateCartCount(res))


});

$(document).ready(function () {

  // select2 example
  $('.select2-basic').select2();
  $('.select2-multi-select').select2();
  $(".select2-auto-tokenize").select2({
    tags: true,
    tokenSeparators: [',']
  });

  // js code for responsive drop-down-menu-item with swing effect
  $(".nav-item>a, .nav-item>ul>li>a").on("click", function () {
    var element = $(this).parent("li");
    if (element.hasClass("open")) {
      element.removeClass("open");
      element.find("li").removeClass("open");
    }
    else {
      element.addClass("open");
      element.siblings("li").removeClass("open");
      element.siblings("li").find("li").removeClass("open");
    }
  });

  // progress bar
  $(".progressbar").each(function () {
    $(this).find(".bar").animate({
      "width": $(this).attr("data-perc")
    }, 3000)
  });

});

$(function () {
  var todoListItem = $('.todo-list');
  var todoListInput = $('.todo-list-input');
  $('.todo-list-add-btn').on("click", function (event) {
    event.preventDefault();
    var item = $(this).prevAll('.todo-list-input').val();
    if (item) {
      todoListItem.append("<li><div class='form-check'><label class='form-check-label'><input class='checkbox' type='checkbox'/>" + item + "<i class='input-helper'></i></label></div><i class='remove fa fa-times'></i></li>");
      todoListInput.val("");
    }
  });
  todoListItem.on('change', '.checkbox', function () {
    if ($(this).attr('checked')) {
      $(this).removeAttr('checked');
    } else {
      $(this).attr('checked', 'checked');
    }
    $(this).closest("li").toggleClass('completed');
  });
  todoListItem.on('click', '.remove', function () {
    $(this).parent().remove();
  });

});

$(".navbar-toggler").on('click', function () {
  $(".main-container").toggleClass("nav-close");
});

$(".main-sidebar .sidebar-close").on('click', function () {
  $(".main-container").removeClass("nav-close");
});

// sidebar scroll
$('#main-sidebar').slimScroll({
  height: '100vh'
});

$('#navbar_search').on('input', function () {
  var search = $(this).val().toLowerCase();
  var search_result_pane = $('#navbar_search_result_area .navbar_search_result');
  $(search_result_pane).html('');
  if (search.length == 0) {
    return;
  }
  // search
  var match = $('.main-sidebar .nav-link').filter(function (idx, elem) {
    return $(elem).text().trim().toLowerCase().indexOf(search) >= 0 ? elem : null;
  }).sort();
  // show search result
  // search not found
  if (match.length == 0) {
    $(search_result_pane).append('<li class="text-muted">No search result found.</li>');
    return;
  }
  // search found
  match.each(function (idx, elem) {
    var item_url = $(elem).attr('href') || $(elem).data('default-url');
    var item_text = $(elem).text().replace(/(\d+)/g, '').trim();
    $(search_result_pane).append(`<li><a href="${item_url}">${item_text}</a></li>`);
  });
});

function proPicURL (input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var preview = $(input).parents('.thumb').find('.profilePicPreview');
      $(preview).css('background-image', 'url(' + e.target.result + ')');
      $(preview).addClass('has-image');
      $(preview).hide();
      $(preview).fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(".profilePicUpload").on('change', function () {
  proPicURL(this);
});

$(".remove-image").on('click', function () {
  $(this).parents(".profilePicPreview").css('background-image', 'none');
  $(this).parents(".profilePicPreview").removeClass('has-image');
  $(this).parents(".thumb").find('input[type=file]').val('');
});


// registration form label animation

$('#reg-email').on('input', function () {
  var emailfield = $(this).val();
  if (emailfield.length < 1) {
    $('#reg-email').removeClass('hascontent');
  } else {
    $('#reg-email').addClass('hascontent');
  }
});

$('#reg-pass').on('input', function () {
  var passfield = $(this).val();
  if (passfield.length < 1) {
    $('#reg-pass').removeClass('hascontent');
  } else {
    $('#reg-pass').addClass('hascontent');
  }
});

$('#reg-pass-again').on('input', function () {
  var passAgainfield = $(this).val();
  if (passAgainfield.length < 1) {
    $('#reg-pass-again').removeClass('hascontent');
  } else {
    $('#reg-pass-again').addClass('hascontent');
  }
});

$('#reg-phone').on('input', function () {
  var phonefield = $(this).val();
  if (phonefield.length < 1) {
    $('#reg-phone').removeClass('hascontent');
  } else {
    $('#reg-phone').addClass('hascontent');
  }
});

function background () {
  var customBg = $('.dashboard-w2');
  var customBg2 = $('.dashboard-w1');
  var customBeforeBg = $('.dashboard-w2');

  customBg.css('background', function () {
    var bg = ('#' + $(this).data('bg'));
    return bg;
  });

  customBg2.css('background', function () {
    var bg = ('#' + $(this).data('bg'));
    return bg;
  });

  customBeforeBg.css('--before-bg-color', function () {
    var beforebg = ('#' + $(this).data('before'));
    return beforebg;
  });
};


//  MANIPULATION OF CART QUANTITY BUTTON
$(document).on('click', '.btn-number', function (e) {
  e.preventDefault();

  // fieldName = $(this).attr('data-field');
  type = $(this).attr('data-type');
  var input = $(this).siblings(".input-text");
  var currentVal = parseInt(input.val());
  if (!isNaN(currentVal)) {
    if (type == 'minus') {
      if (currentVal > input.attr('min')) {
        input.val(currentVal - 1).change();
      }
      if (parseInt(input.val()) == input.attr('min')) {
        $(this).attr('disabled', true);
      }

    } else if (type == 'plus') {

      if (currentVal < input.attr('max')) {
        input.val(currentVal + 1).change();
      }
      if (parseInt(input.val()) == input.attr('max')) {
        $(this).attr('disabled', true);
      }

    }
  } else {
    input.val(0);
  }
});
$(document).on('focusin', '.input-text', function () {
  $(this).data('oldValue', $(this).val());
});
$(document).on('change', '.input-text', function () {

  minValue = parseInt($(this).attr('min'));
  maxValue = parseInt($(this).attr('max'));
  valueCurrent = parseInt($(this).val());
  product_id = parseInt($(this).data('product_id'))

  name = $(this).attr('name');
  if (valueCurrent >= minValue) {
    $(".btn-number[data-type='minus']").removeAttr('disabled')
  } else {
    notify('Minimun quantity reached for this product','error');
    $(this).val($(this).data('oldValue'));
  }
  if (valueCurrent <= maxValue) {
    $(".btn-number[data-type='plus']").removeAttr('disabled')
  } else {
    notify('Maximum quantity reached for this product','error')
    $(this).val($(this).data('oldValue'));
  }



});
$(document).on('keydown', ".input-text", function (e) {
  // Allow: backspace, delete, tab, escape, enter and .
  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
    // Allow: Ctrl+A
    (e.keyCode == 65 && e.ctrlKey === true) ||
    // Allow: home, end, left, right
    (e.keyCode >= 35 && e.keyCode <= 39)) {
    // let it happen, don't do anything
    return;
  }
  // Ensure that it is a number and stop the keypress
  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    e.preventDefault();
  }
});

function notify (message, type, position = 'topRight') {
  if (type == 'error') {
    iziToast.error({
      message,
      position
    });
  } else {
    iziToast.success({
      message,
      position
    });
  }
}

function updatePrice(product_id,quantity_elem,output_elem)
{

  var quantity = $(quantity_elem).val();
  $.ajax({
    url:'update-js-price',
    method:'post',
    data:{product_id,quantity}
  })
  .then(res => {
    if(res.success){
      $(output_elem+product_id).html(res.data);
    }
  })

}

// ADD TO CART FUNCTIONALITY

function addToCart (product_id, quantity = 1) {
  quantity = isNaN(quantity) || quantity == '' ? $(quantity).val() : quantity;
  // if(isNaN(quantity)){
  //   quantity = $(quantity).val();
  // alert(quantity);
  // }
  $.ajax({
    method: "post",
    url: "/user/add-to-cart",
    data: {
      product_id,
      quantity,
    }
  })
    .then(res => processCartCallBack(res))

}

function processCartCallBack (data) {
  // console.log(data.success)
  type = data.success == true ? 'success' : 'error';
  $('#exampleModalCenter').modal('hide');
  updateCartCount(data.data)
  notify(data.message, type)

}

function updateCartCount (count) {
  if (count > 99) {
    count = '99+';
  }
  $('#cart_count').attr('data-count', count);
}