(function($) {
	$.fn.simplePopup = function() {
	
		// ����� ������������
		$.fn.center = function() {
			var popupMarginLeft = -this.width()/2;
			return this.css('margin-left', popupMarginLeft);
		}
		// ����� ������� �������
		function hide() {
			$('.popup_body, .popup').fadeOut(300, 0);
		}
		// �������� �� ������ esc
		$('body').keyup(function(e) {
			if (e.keyCode == 27) {
				hide();
			}
		});
		// �������� �� ���� � �� ��������
		$('.popup_body, .popup_close').click(function() { 
			hide();
			return false;
		});
	
		return this.each(function() {
		
			$(this).click(function() {
				$(".popup_body").fadeTo(300, 0.7); 
				$(".popup").center().fadeTo(300, 1);
				return false;		
			});
			
		});
		
	}
})(jQuery);