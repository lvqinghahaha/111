$(function () {
    var aBtns = $("#banner").find(".dots span");
    var oUl = $("#banner").find("ul");
    var oLeft = $("#banner").find(".left");
    var oRight = $("#banner").find(".right");
    var iNow = 0; //记录要显示的图片的下标
    var timer = null; //轮播效果的定时器
    var isRuning = false;//代表正在动画

    

    timer = setInterval(function () {
      iNow++;
      tab();
    }, 3000);

    //给所有的按钮添加点击
    aBtns.click(function () {
      iNow = $(this).index();
      tab();
    });

    function tab() {
      aBtns.removeClass("active").eq(iNow).addClass("active");
      if (iNow == aBtns.size()) {
        aBtns.eq(0).addClass("active");
      }

      oUl.animate({ left: -2380 * iNow }, 500, function () {
        if (iNow == aBtns.size()) {
          iNow = 1;
          oUl.css("left", 0);
        }
      });
    }

    //给左右按钮添加点击
    oLeft.click (function () {
        if(isRuning = true); //动画开始
          
        iNow--;
        tab();
      });

    oRight.click (function () {
        if(isRuning = true);
        iNow++;
        tab();
      });
  });