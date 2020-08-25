$(function(){
    $("#lefttop").mouseenter(function(){
      $("#dark").add("#big").show();
    }).mouseleave(function(){
      $("#dark").add("#big").hide();
    }).mousemove(function(ev){
        var l = ev.pageX - $(this).offset().left - 100;
        l = Math.max(l, 0);
        l = Math.min(300, l);
        var t = ev.pageY - $(this).offset().top - 100;
        t = Math.max(t, 0);
        t = Math.min(300, t);
      $("#dark").css({
        left: l,
        top: t
      })
      //放大的图片，反方向对应倍数移动
      $("#big img").css({
        left: -2 * l,
        top: -2 * t
      })
    })
  })