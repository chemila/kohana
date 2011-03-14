$(document).ready(function(){
	
	//Sidebar Accordion Menu:
	$("#main-nav li ul").hide();
	
	// Slide down the current menu item's sub menu
	$("#main-nav li.current a").parent().find("ul").slideToggle("slow"); 
	
	// When a top menu item is clicked...
	$("#main-nav li.parent a").click(function () {
			// Slide up all sub menus except the one clicked
			$(this).parent().siblings().find("ul").slideUp("normal"); 
			// Slide down the clicked sub menu
			$(this).next().slideToggle("normal"); 
			return false;
		}
	);
	// When a menu item with no sub menu is clicked...
	$("#main-nav li ul a").click(function () {
			$(this).addClass('actived');
			$(this).parent().siblings().find('a').removeClass('actived');
			$(this).parent().parent().parent().siblings().find('a').removeClass('actived');
			
			// Just open the link instead of a sub menu
			if ($(this).attr('target') != '')
			{
				window.parent.document.getElementById('main_iframe').src=(this.href);
			}	
			else
			{
				window.location.href=(this.href); 
			}
			
			return false;
		}
	); 
	
	/**
	 * Buy hot word
	 */
	$('a.buy_word').click(function(){
		var word = $(this);
		var word_id = word.attr('id');
		word.addClass('hidden')
			.after('<strong id="sending">购买中...</strong>');
		
		$.ajax({
			type: 'GET',
			url: 'index.php',
			data: 'do=word&action=ajax_buy&id=' + word_id,
			dataType: 'text',
			success: function(msg){
				$('#sending').remove();
				if (msg == 'TRUE')
				{
					var user_price = $('#user_price').html();
					var success_msg = '<strong class="green">已购买</strong>';
					
					if (user_price != null)
					{
						var word_price = $('#word_item_'+word_id+' .word_price').html();
						$('#user_price').html(user_price - word_price);
						
						word.after(success_msg).remove();
					}
					else
					{
						word.after(success_msg + 
							'，<a href="index.php?do=product&action=add&id='+word_id+'">添加专题</a>'
							)
							.remove(); 
					}
				}
				else if (msg == 'FALSE')
				{
					alert('购买错误，请重试');
					word.removeClass('hidden');
				}
				else
				{
					alert(msg);
					word.removeClass('hidden');
				}
			}
		});
		
		return false;
	});
	
	/** 
	 * Hot word cata filter
	 */
	$('#cata_switcher').change(function(){
		var cata_id = $(this).find('option:selected').val();
		var redirect_url = 'index.php?do=word&action=selling&cata='+cata_id;
		$(location).attr('href', redirect_url);
	});

	/**
	 * buildings of city filter
	 */
	$('#city_switcher').change(function(){
		var city_id = $(this).find('option:selected').val();
		var uri = $('#current_uri').val();
		
		if (city_id != 'none')
		{
			var regex = /city=(\d+)/g;
			if (regex.test(uri))
			{
				uri = uri.replace(regex, 'city='+city_id);
			}
			else
			{
				uri += '&city=' + city_id;
			}
	
			$(location).attr('href', uri);
		}
	}).find('option').click(function(){
		var city_id = $(this).val();
		var uri = $('#current_uri').val();
		
		if (city_id != 'none')
		{
			var regex = /city=(\d+)/g;
			if (regex.test(uri))
			{
				uri = uri.replace(regex, 'city='+city_id);
			}
			else
			{
				uri += '&city=' + city_id;
			}
			
			$(location).attr('href', uri);
		}
	});
	
	/**
	 * Page skip
	 */
	$('.page_skip').click(function(){
		var skip_url = $('#current_uri').val();
		var current_page = $('#current_page').val();
		var total_page = $('#total_page').val();
		var skip_number = $.trim($(this).parent('div').find('input.skip_number').val());
	
		if (skip_number == '')
		{
			alert('您还没有填写跳转的页码');
			return;
		}
		else if (skip_number.search(/^\d+$/) != 0)
		{
			alert('您填写的不是数字');
			return;
		}
		else
		{
			skip_number = Number(skip_number);
			current_page = Number(current_page);
			total_page = Number(total_page);
			if (skip_number == current_page)
			{
				alert('当前就是第 ' + current_page + ' 页');
				return;
			}
			else if (skip_number > total_page)
			{
				alert('跳转页数不能超过总页数（' + total_page + '）');
				return;
			}
			else
			{
				var regex = /page=(\d+)/g;
				if (regex.test(skip_url))
				{
					skip_url = skip_url.replace(regex, 'page='+skip_number);
				}
				else
				{
					skip_url += '&page=' + skip_number;
				}
	
				$(location).attr('href', skip_url);
			}
		}
	});
	
	/**
	 * To give up add product url warning
	 */
	$('#product_word').click(function(){
		var product_url = $('#product_url');
		
		if (product_url.val() != '' && ! confirm('您确信要放弃添加专题？'))
		{
			return false;
		}
	});
	
	/**
	 * Highlight current line
	 */
	$('.item_list tr').click(function(){
		$('.item_list tr').removeClass('highlight');
		$(this).addClass('highlight');
	});
	
	/**
	 * Delete product warning
	 */
	$('#delete_product').click(function(){
		if ( ! confirm('您确信要删除专题和所有统计的流量数据吗？\n\n注意：此操作不可逆！'))
		{
			return false;
		}
	});
	
	/**
	 * Edit building status
	 */
	$('.building_status').editInPlace({
		url: 'index.php?do=building&action=ajax_edit&type=status',
		element_id: $(this).attr('id'),
		field_type: 'select',
		bg_over: '#DDF8CC',
		select_options: '投放:1, 不投放:0',
		default_text: ''
	});
	
	/**
	 * Edit building rank
	 */
	$('.building_rank').editInPlace({
		url: 'index.php?do=building&action=ajax_edit&type=rank',
		element_id: $(this).attr('id'),
		field_type: 'select',
		bg_over: '#DDF8CC',
		select_options: '0,1,2,3,4,5,6,7,8,9,10'
	});

	/**
	 * Edit building nature rank
	 */
//	$('.building_nature_rank').editInPlace({
//		url: 'index.php?do=building&action=ajax_edit&type=rank',
//		element_id: $(this).attr('id'),
//		field_type: 'select',
//		bg_over: '#DDF8CC',
//		select_options: '0,1,2,3,4,5,6,7,8,9,10'
//	});
	
	/**
	 * Edit building keywords
	 */
	$('.building_keywords').editInPlace({
		url: 'index.php?do=building&action=ajax_update&type=keywords',
		element_id: $(this).attr('id'),
		bg_over: '#DDF8CC',
		default_text: ''
	});
	
	/**
	 * Edit building idea
	 */
	$('.building_idea').editInPlace({
		url: 'index.php?do=building&action=ajax_edit&type=idea',
		element_id: $(this).attr('id'),
		bg_over: '#DDF8CC',
		default_text: ''
	});

	$('.delete_confirm').click(function(){
		if ( ! confirm('您确信要删除吗？'))
		{
			return false;
		}
	});
//
//	/**
//	 * Fetch Server Log switch
//	 */
//	$('#fs_log_switcher').change(function(){
//		var worker_id = $(this).find('option:selected').val();
//		var redirect_url = 'index.php?do=fetchserver_log&action=lists&id='+worker_id;
//		$(location).attr('href', redirect_url);
//	});
//
//	/**
//	 * Fetch Server Error switch
//	 */
//	$('#fs_error_switcher').change(function(){
//		var worker_id = $(this).find('option:selected').val();
//		var start_date = $('#start_date').val();
//		var end_date = $('#end_date').val();
//		var redirect_url = 'index.php?do=fetchserver_error&action=lists&id='+
//			worker_id+'&start_date='+start_date+'&end_date='+end_date;
//		$(location).attr('href', redirect_url);
//	});
});

/**
 * Get Xpath location of an element
 * @param Element 	
 * @return string
 */
function getElementXPath(elt)
{
	var path = '';
	for (; elt && elt.nodeType == 1; elt = elt.parentNode)
	{
		idx = getElementIdx(elt);
		xname = elt.tagName;
		if (idx > 1) xname += '[' + idx + ']';
		path = '/' + xname + path;
	}

	return path;	
}

/**
 * Get Idx of an element
 * @param Element
 * @return int
 */
function getElementIdx(elt)
{
    var count = 1;
    for (var sib = elt.previousSibling; sib ; sib = sib.previousSibling)
    {
        if(sib.nodeType == 1 && sib.tagName == elt.tagName)	count++
    }
    
    return count;
}