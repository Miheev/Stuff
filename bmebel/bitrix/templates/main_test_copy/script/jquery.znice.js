/*
 * zNice 
 * version: 1.0 (07.12.2013)
 * by Vitaliy Grozinskiy (zendo@ukr.net) 
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * To Use: place in the head 
 *  <link href="style/zNice.css" rel="stylesheet" type="text/css" />
 *  <script type="text/javascript" src="js/jquery.zNice.js"></script>
 *
 * And apply the zNice class to the form you want to style, or use $(selector).zNice(settings);
 *
 *
 * Based on jNice by Sean Mooney (sean@whitespace-creative.com) 
 * 
 ******************************************** */
(function($){
	$.fn.zNice = function(settings){
		var self = this;
		self.selectItems=$();
		if (typeof(settings)==='undefined') settings={};
		$.extend(
			settings,
			{
				zValidate : true,
				//aBackground  : true,
				sExpandSelector : '.zNice-select-text,.zNice-select-open'
			}
		);
		
		if (settings.zValidate){
			$(self).zValidate();
		}

		function makeBackground($element) {
			$element.addClass('zNice-aBackground');
			$element.append('<span class="zNice-bgtl"></span><span class="zNice-bgtr"></span><span class="zNice-bgbl"></span><span class="zNice-bgbr"></span><span class="zNice-bgsl"></span><span class="zNice-bgsr"></span>');
		}

		self.isDisabled = function($element){
			if ($element[0].disabled)
				$element.disable();
			else
				$element.enable();
		}


		
		self.makeWrap = function($element){
			var $wrapper=$('<span class="zNice-wrap"></span>');
			$element.before($wrapper)
			$element.appendTo($wrapper);
			if (typeof($element.attr('class'))!=='undefined'){
				var c=$element.attr('class').split(' ');
				$(c).each(function(i){
					if (this.length>0) $element.removeClass(c[i]);
					$wrapper.addClass(c[i]);
				})
			}
			$wrapper.prepend('<span class="zNice-bg"></span>');
			$element.focus(function(){ 
				$wrapper.addClass('zNice-focus');
			}).blur(function(){
				$wrapper.removeClass('zNice-focus');
			});

			$element.disable = function($element){
				this.zDisabled=true;
				this.zWrap.addClass('zNice-disabled');
			}
			$element.enable = function($element){
				this.zDisabled=false;
				this.zWrap.removeClass('zNice-disabled');
			}
			return	$wrapper;
		}

		self.tareaAdd = function(){
			var $element = $(this);
			var $wrapper = self.makeWrap($element)
			$wrapper.addClass('zNice-tArea');
			
			if (settings.aBackground){
				makeBackground($wrapper);
			}
		};

		self.tinputAdd = function(){
			var $element = $(this);
			var $wrapper = self.makeWrap($element)
			$wrapper.addClass('zNice-tInput');
			
			if (settings.aBackground){
				makeBackground($wrapper);
			}
			
			if (typeof($element.data('image'))!=='undefined'){
				$wrapper.addClass('zNice-tInput-image').append('<span class="zNice-image"><span class="vfix"></span><img src="'+$element.data('image')+'" alt=""/></span>');
			}
			if (typeof($element.data('color'))!=='undefined'){
				$wrapper.addClass('zNice-tInput-color').append('<span class="zNice-color" style="background:'+$element.data('color')+'"></span>');
			}
			if (typeof($element.data('ztype'))!=='undefined'){
				if ($element.data('ztype')=='qInput'){
					$wrapper.addClass('zNice-qInput');
					$wrapper.removeClass('zNice-tInput');
					$wrapper.wrapInner('<span class="zNice-tInput"></span>')
					$wrapper.append('<span class="zNice-qInput-control zNice-qInput-inc"></span>').prepend('<span class="zNice-qInput-control zNice-qInput-dec"></span>')
					$('.zNice-qInput-control',$wrapper).click(function(event){
						event.preventDefault();
						if ($(this).is('.zNice-qInput-inc')) $element.val($element.val()*1+1);
						else $element.val($element.val()>1 ? $element.val()-1 : 1);
						$element.change();
					})
					$element.keypress(function(e){
						e.preventDefault();
						var str1='';
						var c = String.fromCharCode(e.which);
						var str=$(this).val()+c;
						for (i=0;i<=str.length;i++)
							if(str[i]*1>0) str1=str1+str[i];
						str1=str1.substr(0,5);
						$(this).val(str1);
						$(this).change();
					})		
				}
			}
		};
		self.checkAdd = function(){
			var $element = $(this);

			$element.zWrap = self.makeWrap($element);
			$element.zWrap.addClass('zNice-checkbox');
			self.isDisabled($element);

			/* Click Handler */
			$element.zWrap.click(function(e){
				$element[0].checked=!$element[0].checked;
				$element.change();
				e.preventDefault();
			});
				
			$element.change(function(){
				if(this.checked){ $element.zWrap.addClass('zNice-checked'); 	}
				else { $element.zWrap.removeClass('zNice-checked'); }
			});
			
			/* set the default state */
			if (this.checked) {$element.zWrap.addClass('zNice-checked');}
		};
		self.radioAdd = function(){
			var $element = $(this);
			var $form=$element.closest('form');

			$element.zWrap = self.makeWrap($element);
			$element.zWrap.addClass('zNice-radio');
			self.isDisabled($element);

			/* Click Handler */
			$element.zWrap.click(function(e){
				if (!$element[0].checked) {
					$element[0].checked=!$element[0].checked;
					$element.change();
				}
				e.preventDefault();
			});
				
			$element.change(function(){
				if(this.checked){ 
					$element.zWrap.addClass('zNice-checked'); 	
					$('input:radio[name="'+ $element.attr('name') +'"]',$form).not($element).each(function(){
						var $element=$(this).data('zNice-radio');
						$element.attr('checked',false);
						$element.zWrap.removeClass('zNice-checked');
					});
				}
				else { $element.zWrap.addClass('zNice-checked'); }
			});
		
			/* set the default state */
			if (this.checked) {$element.zWrap.addClass('zNice-checked');}
			$element.data('zNice-radio',$element);
		};
		self.selectAdd = function(){
			var $element = $(this);
			$element.zWrap = self.makeWrap($element);
			$element.zWrap.addClass('zNice-select');
			$element.zOptions=new Array();
			$element.zText=$('<span class="zNice-select-text"></span>');
			$element.zOpener=$('<span class="zNice-select-open"></span>');
			$element.zOptionsList=$('<ul class="zNice-select-list"></ul>');
			$element.zWrap.append($element.zText,$element.zOpener,$element.zOptionsList);
			self.isDisabled($element);


			/* Expanding select*/
			$element.expand = function(){
				$element.zWrap.addClass('zNice-expanded');
				$element.zExpanded=true;
			}
			/* Contracting select*/
			$element.contract = function(){
				$element.zWrap.removeClass('zNice-expanded');
				$element.zExpanded=false;
			}

			/* Changing select option*/
			$element.selectOption = function(index,event){
				var $option=$($element.zOptions[index]).data('zNiceOption');
				var optionIndex=$element.find('option').index($option.element)

				if (typeof(event)==='undefined') event=true;
				$($element.zOptions).removeClass('zNice-selected');
				$option.addClass('zNice-selected');
				$element.zText.html($($element.zOptions[index]).html());
				if (event && $element[0].selectedIndex != optionIndex) {
					$element[0].selectedIndex = optionIndex;
					$element.change();
				}
				else 
					$element[0].selectedIndex = optionIndex;
			}

			/* Init/reinit Select*/
			$element.updateOptions = function(){
				$element.find('option').each(function(){
					$element.addOption(this);
				})
				$element.selectOption($element[0].selectedIndex,false);
			}

			/* Adding option to select*/
			$element.addOption = function(option,oIndex){
				if (typeof(oIndex)==='undefined') oIndex=99999;
				var $option=$('<li></li>');
				$option.element=option;
				$option.html('<span class="zNice-select-item">'+$(option).html()+'</span>');
				if ($(option).data('disabled')=='disabled') $option.addClass('zNice-disabled');
				if (typeof($(option).data('color'))!=='undefined') {
					$option.find('.zNice-select-item').addClass('zNice-select-color').prepend('<b class="zNice-color" style="background:'+$(option).data('color')+'"></b>');
				}
				if (typeof($(option).data('image'))!=='undefined') {
					$option.find('.zNice-select-item').addClass('zNice-select-image').prepend('<span class="zNice-image"><img src="'+$(option).data('image')+'" alt="" /></span>');
				}

				if (oIndex==0) $element.zOptionsList.prepend($option);
				else if (oIndex>$element.zOptions.length) $element.zOptionsList.append($option);
				else $element.zOptionsList.find('li:eq('+oIndex+')').prepend($option);
				$option.click(function(){
					$element.selectOption($($element.zOptions).index(this));
					self.selectHide();
				})
				$option.data('zNiceOption',$option);
				$element.zOptions.push($option[0]);
			}
			$element.zWrap.on('click',settings.sExpandSelector,function(e){
				
				if (!$element.zExpanded && !$element.zDisabled) {
					self.selectHide();
					$element.expand();
				}
				else self.selectHide();
				e.preventDefault();
			});
			$element.keydown(function(e){
				var selectedIndex = this.selectedIndex;
				switch(e.keyCode){
					case 40: /* Down */
						if (selectedIndex < this.options.length - 1){ $element.selectOption(selectedIndex+1); }
						break;
					case 38: /* Up */
						if (selectedIndex > 0){ $element.selectOption(selectedIndex-1); }
						break;
					default:
						return;
						break;
				}
				return false;
			})
			$element.updateOptions();
			self.selectItems.push($element);
		}
		self.selectShow = function(){
			$selects=this.selectItems;
			$selects.each(function(){
				this.expand()
			})
		}
		self.selectHide = function(){
			$selects=this.selectItems;
			$selects.each(function(){
				this.contract();
			})
		}


		self.checkExternalClick = function(event) {
			if ($(event.target).parents('.zNice-expanded').length === 0) { self.selectHide(); }
		};
		$(document).mousedown(self.checkExternalClick);

		
		if (self.data('zNice')) return false;
		self.data('zNice',self);

		/* each form */
		return this.each(function(){
			$('input:submit, input:reset, input:button,.button', this).each(ButtonAdd);
			$('.button',this).each(function(){
				$(this).mousedown(function(){ 
					$(this).addClass('zNiceClicked');
					return false;
				});
			});
			$(document).mouseup(function(){
				$('.button.zNiceClicked').removeClass('zNiceClicked');
			})
			$('textarea', this).each(self.tareaAdd);
			$('input:text:visible, input:password, input[type="email"]', this).each(self.tinputAdd);
			$('input:checkbox', this).each(self.checkAdd);
			$('input:radio', this).each(self.radioAdd);
			$('input:file', this).each(IfileAdd);
			$('select', this).each(self.selectAdd);
			/* Add a new handler for the reset action */
			$(this).bind('reset',function(){var form;var action = function(){ Reset(form); }; window.setTimeout(action, 10); });
			$('.zNiceHidden').css({opacity:0});
		});

	};/* End the Plugin */


	var Reset = function(form){
		var sel;
		$('.zNiceSelectWrapper select', form).each(function(){sel = (this.selectedIndex<0) ? 0 : this.selectedIndex; $('ul', $(this).parent()).each(function(){$('a:eq('+ sel +')', this).click();});});
		$('.zNiceCheckbox, .zNiceRadio', form).removeClass('zNiceChecked');
		$('input:checkbox, input:radio', form).each(function(){
			if($(this).is(':checked')){$('a', $(this).parent()).addClass('zNiceChecked');}
		});
	};

	var IfileAdd = function(){
		iclass=$(this).attr('class');
		title=$(this).attr('title');
		var $input = $(this).addClass('zNiceInput').wrap('<span class="zNiceInputWrapper fileupload '+(typeof(iclass)!='undefined'? iclass : '') +'"></span>').before('<span class="zNiceInputBg"><span class="zNiceInputLeft">'+(typeof($(this).attr('placeholder'))!='undefined' ? $(this).attr('placeholder') : '')+'</span><span class="zNiceInputRight"></span></span><span class="ubutton"><span class="ileft">'+(typeof(title)!=='undefined' ? title : 'Обзор')+'</span><span class="iright"></span></span>');
		var $wrapper = $input.parents('.zNiceInputWrapper');
		$input.focus(function(){ 
			$wrapper.addClass('zNiceInputWrapper_hover');
		}).blur(function(){
			$wrapper.removeClass('zNiceInputWrapper_hover');
		});
		$input.change(function(){
			filename=$(this).val();
			filename=filename.split('\\');
			$('.zNiceInputBg .zNiceInputLeft',$wrapper).html(filename[filename.length-1]).css('color','#030303');
		});
	};

	var ButtonAdd = function(){
		if (!$(this).is('.button')){
			value=$(this).attr('value');
			iclass=$(this).attr('class');
			$(this).attr('class','');
			$(this).attr('value','');
			$(this).wrap('<span class="button '+(typeof(iclass)!='undefined'? iclass : '') +'"></span>');
			$(this).parent().append('<span class="ileft">'+value+'</span>');
			$(this).parent().append('<span class="iright"></span>');
		}
		else{
			value=$(this).html();
			$(this).html('<span class="ileft">'+value+'</span><span class="iright"></span>');
		}
	};

	/* Automatically apply to any forms with class zNice */
	$(function(){$('.zNice').zNice();});
})(jQuery);