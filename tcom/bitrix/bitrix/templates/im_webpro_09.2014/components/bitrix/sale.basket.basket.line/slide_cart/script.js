
var sbbl = {

	toggleExpandCollapseCart: function ()
	{
		if (sbbl.bClosed)
		{
			BX.removeClass(sbbl.elemBlock, "close");
			sbbl.elemStatus.innerHTML = sbbl.strCollapse;
			sbbl.bClosed = false;
		}
		else // Opened
		{
			BX.addClass(sbbl.elemBlock, "close");
			sbbl.elemStatus.innerHTML = sbbl.strExpand;
			sbbl.bClosed = true;
		}
		setTimeout(sbbl.toggleMaxHeight, 100);
	},

	fixCartAfterAjax: function ()
	{
		if (sbbl.elemBlock)
		{
			sbbl.elemStatus = BX("bx_cart_block_status");
			if (sbbl.bClosed)
				sbbl.elemStatus.innerHTML = sbbl.strExpand;
			else // Opened
				sbbl.elemStatus.innerHTML = sbbl.strCollapse;

			sbbl.elemProducts = BX('bx_cart_block_products');
		}
	},

	fixCartTopPosition: function()
	{
		//var elemPanel = BX("bx-panel");
		//if (elemPanel)
		//{
		//	sbbl.elemBlock.style.top = elemPanel.offsetHeight + 5 + 'px';
		//	setTimeout(sbbl.toggleMaxHeight, 100);
		//}
	},

	toggleMaxHeight: function()
	{
		//if (! sbbl.elemProducts)
		//	return;
        //
		//if (sbbl.bClosed)
		//{
		//	if (sbbl.bMaxHeight)
		//	{
		//		BX.removeClass(sbbl.elemBlock, 'max_height');
		//		sbbl.bMaxHeight = false;
		//	}
		//}
		//else // Opened
		//{
		//	var windowHeight = 'innerHeight' in window
		//		? window.innerHeight
		//		: document.documentElement.offsetHeight;
        //
		//	if (sbbl.bMaxHeight)
		//	{
		//		if (sbbl.elemProducts.scrollHeight == sbbl.elemProducts.clientHeight)
		//		{
		//			BX.removeClass(sbbl.elemBlock, 'max_height');
		//			sbbl.bMaxHeight = false;
		//		}
		//	}
		//	else
		//	{
		//		if (sbbl.bVerticalTop)
		//		{
		//			if (sbbl.elemBlock.offsetTop + sbbl.elemBlock.offsetHeight >= windowHeight)
		//			{
		//				BX.addClass(sbbl.elemBlock, 'max_height');
		//				sbbl.bMaxHeight = true;
		//			}
		//		}
		//		else
		//		{
		//			if (sbbl.elemBlock.offsetHeight >= windowHeight)
		//			{
		//				BX.addClass(sbbl.elemBlock, 'max_height');
		//				sbbl.bMaxHeight = true;
		//			}
		//		}
		//	}
		//}
	},

	refreshCart: function (data)
	{
		if (! data)
			data = {};

		data.sessid = BX.bitrix_sessid();
		data.siteId = sbbl.siteId;
		data.templateName = sbbl.templateName;
		data.arParams = sbbl.arParams;

		BX.ajax({
			url: sbbl.ajaxPath,
			method: 'POST',
			dataType: 'html',
			data: data,
			onsuccess: function(result)
			{
				if (sbbl.elemBlock) {
                    sbbl.elemBlock.innerHTML = result;
                    ready_basket();
                }

				//setTimeout(sbbl.toggleMaxHeight, 100);
			}
		});
	},

	removeItemFromCart: function (id)
	{
		sbbl.refreshCart ({sbblRemoveItemFromCart: id});
	}
};


