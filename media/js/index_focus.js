    $(document).ready(function() {
		   var currentIndex = 0;
            var DEMO; //函数对象
            var currentID = 0; //取得鼠标下方的对象ID
            var pictureID = 0; //索引ID
            $("#ifocus_piclist li").eq(0).show(); //默认
            autoScroll();
            $("#ifocus_btn li").hover(function() {
                StopScrolll();
                $("#ifocus_btn li").removeClass("current")//所有的li去掉当前的样式加上正常的样式
                $(this).addClass("current"); //而本身则加上当前的样式去掉正常的样式
                currentID = $(this).attr("id"); //取当前元素的ID
                pictureID = currentID.substring(currentID.length - 1); //取最后一个字符
                $("#ifocus_piclist li").eq(pictureID).fadeIn("slow"); //本身显示
                $("#ifocus_piclist li").not($("#ifocus_piclist li")[pictureID]).hide(); //除了自身别的全部隐藏
                $("#ifocus_tx li").hide();
                $("#ifocus_tx li").eq(pictureID).show();

            }, function() {
                //当鼠标离开对象的时候获得当前的对象的ID以便能在启动自动时与其同步
                currentID = $(this).attr("id"); //取当前元素的ID
                pictureID = currentID.substring(currentID.length - 1); //取最后一个字符
                currentIndex = pictureID;
                autoScroll();
            });
            //自动滚动
            function autoScroll() {
                $("#ifocus_btn li:last").removeClass("current");
                $("#ifocus_tx li:last").hide();
                $("#ifocus_btn li").eq(currentIndex).addClass("current");
                $("#ifocus_btn li").eq(currentIndex - 1).removeClass("current");
                $("#ifocus_tx li").eq(currentIndex).show();
                $("#ifocus_tx li").eq(currentIndex - 1).hide();
                $("#ifocus_piclist li").eq(currentIndex).fadeIn("slow");
                $("#ifocus_piclist li").eq(currentIndex - 1).hide();
                currentIndex++; currentIndex = currentIndex >= 4 ? 0 : currentIndex;
                DEMO = setTimeout(autoScroll, 2000);
            }
            function StopScrolll()//当鼠标移动到对象上面的时候停止自动滚动
            {
                clearTimeout(DEMO);
            }
	});
