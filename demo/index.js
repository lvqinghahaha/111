$(function () {
    var aBtns = $("#banner").find(".dots span");
    var oUl = $("#banner").find("ul");
    var oLeft = $("#banner").find(".left");
    var oRight = $("#banner").find(".right");
    var iNow = 0; //记录要显示的图片的下标
    var timer = null; //轮播效果的定时器
  
  function tab() {
    aBtns.removeClass("active").eq(iNow-1).addClass("active");
    if (iNow -1== aBtns.size()) {
      aBtns.eq(0).addClass("active");
    }
    oUl.animate({ left: -1190 * iNow }, 500, function () {
      if (iNow == aBtns.size()) {
        iNow = 0;
        oUl.css("left", 0);
      }
    });
  }
  //小圆点添加点击
  aBtns.click(function () {
    iNow= $(this).index()+ 1;
    tab();
  });
  //自动轮播
  timer = setInterval(function () {
    iNow++;
    tab();
  }, 3000);
  //给左右按钮添加点击
  oLeft.click (function () {
    iNow--;
    tab();
  });

  oRight.click (function () {
      iNow++;
      tab();
  });
})

