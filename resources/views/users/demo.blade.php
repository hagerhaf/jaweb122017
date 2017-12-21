
@extends('layouts.default')

@section('title')
{{ trans('hifone.users.edit_profile') }}@parent
@stop

@section('content')



  <!-- &#x1F335; -->
  
  <style>
  
input {
  border: 1px solid #ccc;
  border-radius: 3px;
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
  padding: 10px;
  width: calc(100% - 20px);
}

.emoji-picker {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 2px;
  height: 300px;
  overflow: auto;
  overflow-y: scroll;
}
.emoji-picker .emoji-group .emoji-category {
  color: grey;
  font-family: sans-serif;
  font-size: 0.8em;
  font-weight: bold;
  padding: 4px;
}
.emoji-picker .emoji-group .emoji {
  background-color: inherit;
  border-radius: 2px;
  cursor: pointer;
  display: inline-block;
  font-size: 1.2em;
  margin: 2px;
  padding: 0 4px;
}
.emoji-picker .emoji-group .emoji:hover {
  background-color: lightgrey;
}
.emoji-picker .emoji-group .emoji.emoji-with-types {
  position: relative;
}
.emoji-picker .emoji-group .emoji.emoji-with-types::before {
  content: "";
  position: absolute;
  border-color: grey;
  border-width: 5px;
  border-style: solid;
  border-bottom-color: transparent;
  border-top-color: transparent;
  border-right-color: transparent;
  -webkit-transform: rotate(-45deg);
  right: -3px;
  top: -3px;
}
.emoji-picker .emoji-group .emoji .emoji-types {
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0px 0px 10px #000;
  display: none;
  left: -20px;
  position: absolute;
  top: -40px;
  width: 212px;
  z-index: 1;
}
.emoji-picker .emoji-group .emoji .emoji-types.visible {
  display: block;
}
.emoji-picker .emoji-group .emoji .emoji-types::after {
  content: "";
  border-color: grey;
  border-width: 5px;
  border-style: solid;
  border-bottom-color: transparent;
  border-right-color: transparent;
  border-left-color: transparent;
  position: absolute;
  left: 30px;
  bottom: -10px;
}

  </style>
  
  <div class="inbox"></div>
  
  <form action="/createmsg" method="post">

   <link rel="stylesheet" href="css/style.css">


    <div class="field">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
      <textarea name='msg_body' > </textarea>
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

    <script type="text/javascript">var emojiPicker = {
	emojiData : {},
	initialize: function(emojiData) {
		this.emojiData = emojiData;
		return this;
	},
	parseUnicode: function(emojiUnocode) {
		return emojiUnocode
			.replace(/u[+]/gi, '&#x')
			.replace(/ /gi, ';')
			+ ';';
	},
	renderEmojiGroup: function(emojiGroupName) {
		var $emojis = $('<div />', { class: 'emoji-group'});
		$emojiCategory = $('<div />', {class: 'emoji-category'});
		$emojiCategory.text(emojiGroupName);
		$emojis.append($emojiCategory);
		return $emojis;
	},
	renderEmoji: function(emoji) {
		var $emoji = $('<div />', {class: 'emoji'});
		var emojiCode = this.parseUnicode(emoji.code);
		$emoji.html(emojiCode);
		$emoji.attr('title', emoji.no + ' : ' + emoji.code);
		
		if ( emoji.hasOwnProperty('types') ) {
			var $emojiTypes = $('<div />', {class: 'emoji-types'});
			$emojiTypes.append($emoji.clone());
			
			for (var type in emoji.types) {
				var $emojiType = $('<div />', { class: 'emoji'});
				var emojiCode = this.parseUnicode(emoji.types[type]);
				$emojiType.html(emojiCode);
				$emojiTypes.append($emojiType);
			}
			
			$emoji.append($emojiTypes);
			$emoji.addClass('emoji-with-types');
		}
		
		return $emoji;
	},
	render: function() {
		var $emojiPicker = $('<div />', {class: 'emoji-picker'});
		for(var emojiGroup in this.emojiData) {
			var $emojiGroup = this.renderEmojiGroup(emojiGroup);
			
			for(var emoji in this.emojiData[emojiGroup]) {
				if (this.emojiData[emojiGroup][emoji].flagged || this.emojiData[emojiGroup][emoji].no === 18) continue;
				
				var $emoji = this.renderEmoji(this.emojiData[emojiGroup][emoji])
				$emojiGroup.append($emoji);
			}
			
			$emojiPicker.append($emojiGroup);
		}
		
		return $emojiPicker;
	}
};

$(function() {
		$.getJSON('https://api.myjson.com/bins/4sz7d', function(emojiData) {
		var $emojiPicker = emojiPicker.initialize(emojiData).render();
		$('body').append($emojiPicker);
	});
	
	
	
	var $input = $('textarea');
	//var $colClass = $input.getAttribute('name');
	
	
	//if($colClass!='msg_body'){
	$('body').on('click', '.emoji-picker>.emoji-group>.emoji:not(.emoji-with-types), .emoji-picker>.emoji-group>.emoji.emoji-with-types>.emoji-types>.emoji', function() {
		$input.val($input.val() + $(this).text());
		$input.focus();
	}).on('click', '.emoji-picker>.emoji-group>.emoji.emoji-with-types', function() {
		$('.emoji-types.visible').not( $(this).find('.emoji-types') ).toggleClass('visible');
		$(this).find('.emoji-types').toggleClass('visible');
	});
	//}
});</script>
    </div>

   <td colspan='2'><input type='submit' /></td>

  </form>


@stop