$(function () {
  $(".form-reply").submit(function () {
    if ($(this).find('.form-reply-item').val() == '') {
      alert('请填写评价内容');
      return false;
    }
    App.submit();
    return false;
  });
  var bannerSwiper = new Swiper('.swiper-container-banner', {
    autoplay: 0,
    direction: 'horizontal',
    loop: true,
    pagination: '.swiper-pagination',
    paginationClickable: false,
    autoHeight: true,
    onSlideChangeStart: function (swiper) {
      var H = $(".content-slide").eq(swiper.activeIndex).height();
      $(".swiper-slide").css('height', H + 'px');
      $(".swiper-wrapper").css('height', H + 'px');
    }
  });
  $(".hobby-box li").click(function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).find("input[type='checkbox']").attr("checked", false);
    } else {
      $(this).addClass("active");
      $(this).find("input[type='checkbox']").attr("checked", true);
    }
  });
});
//----------------------------------------------------------------
$(function () {
  $(".posts-list").on("click", '.open-arrow', function (e) {
    var parent = $(e.currentTarget).parent('.contentbox');
    if (parent.hasClass("open")) {
      parent.removeClass("open");
    } else {
      parent.addClass("open");
    }
  })
})
//----------------------------------------------------------------
var mySwiperhot = new Swiper('.swiper-container-hot', {
  freeMode: true,
  centeredSlides: false,
  slidesPerView: 3,
  paginationClickable: true,
  onTouchStart: function (swiper, even) {
    swiper.unlockSwipeToPrev();
    swiper.unlockSwipeToNext();
    if (swiper.isEnd) {
      swiper.lockSwipeToNext();
    } else if (swiper.activeIndex == 0) {
      swiper.lockSwipeToPrev();
    }
  }
});
$(function () {
  $(document).on("click", ".commu-review .tips, .FooterComment", function (e) {
    $("#CommentFrom input[name=is_reply]").val(0);
    $("#CommentFrom input[name=comment_pid]").val(0);
    $(".form-comm-reply").show();
    $(".community-footer").hide();
    $("input[type='text']").focus();
  });
  $(document).on("click", ".replay", function (e) {
    $("#CommentFrom input[name=is_reply]").val(1);
    var comment_id = $(this).attr('data-comment-id');
    $("#CommentFrom input[name=comment_pid]").val(comment_id);
    $(".form-comm-reply").show();
    $(".community-footer").hide();
    $("input[type='text']").focus();
  });
  $(".review").not(".commu-review .tips, .replay").on("click", function (e) {
    $(".form-comm-reply").hide();
    $(".community-footer").show();
  });
  scroll();
});
function scroll() {
  var headerEle = $(".jm-header.header-fixed.transparent-bg.scroll");
  var target = $(".shop-community-detail .head");
  $(window).scroll(function (e) {
    var targetHight = target.height();
    var initOpacity = 0.3;
    var scrollTop = $(window).scrollTop();
    var scale = scrollTop / targetHight;
    headerEle.removeClass('bottom-line');
    if (scale > 1) {
      scale = 1;
      headerEle.addClass('bottom-line');
    } else if (scale < initOpacity) {
      scale = initOpacity;
    }
    headerEle.css({opacity: scale});
  });
}
$('.footer_item').on('click', '.Community_like', function () {
  var like = $(this).attr('data');
  var obj = $(this).find('i');
  var text = $(this).find('.LikeNum');
  $.ajax({
    url: "index.php?m=share&a=like",
    type: "POST",
    data: {st_id: like},
    async: false,
    dataType: 'json',
    success: function (data) {
      if (data.statu == 1) {
        if (data.is_del == 1) {
          text.html(parseInt(text.html()) - 1);
          obj.attr("class", "icon_footer_commu_praise");
        } else {
          text.html(parseInt(text.html()) + 1);
          obj.attr("class", "icon_footer_commu_praise_like");
        }
      } else {
        alert("点赞失败");
      }
    },
    error: function (data) {
      alert("点赞失败");
    }
  });
});