<div class="searchbox">
    <div class="rfield" style="display:none;">
        <input type="text" placeholder="What are you looking for?" name="search_text" id="search_text" />
        <i class="fas fa-search" style="cursor:pointer" onclick="searchVideo()"></i>
    </div>
    <!-- test -->
    <div class="logo_mobile">

    </div>
    <div class="cats">
        <div style="display: block; float: left;"> <span title="What are Greater Community Intentions?" style="background: rebeccapurple; background: -webkit-linear-gradient(left, orange , yellow, green, cyan, blue, violet); background: -o-linear-gradient(right, orange, yellow, green, cyan, blue, violet); background: -moz-linear-gradient(right, orange, yellow, green, cyan, blue, violet); background: linear-gradient(to right, orange , yellow, green, cyan, blue, violet);" class="dot">
                <a class="tooltip2" style="padding-left: 7px; color: #ffffff; text-shadow: 2px 2px 4px #000;" href="#"> ? <span class="aboutgci"><em>Greater Community Intentions</em> Use the colored dots to sort through the different styles of community gathering around the world.</span></a>
            </span></div>
        <?php
        foreach($gci_tags as $tag){
            echo '<span data-toggle="tooltip" data-animation="true" data-placement="bottom" title="'.$tag['tag'].'" onclick="searchByTag(\''.$tag['id'].'\')" style="background-color: '.$tag['tag_color'].'" class="dot"></span>';
        } ?>
    </div>
    <div style="width:100%; float:left; position:relative;">
{{--        <a href="#" class="btn">Random</a>--}}
        <div class="filters" style="float: left; width: 55%; position: relative;">
            <select id="content_sorting">
                <option value="">Sort By</option>
                <option value="comments">Recent comments</option>
                <option value="videos">Recent videos</option>
                <option value="random">Random</option>
            </select>
        </div>
{{--		<div id="select-dropdown" class="closed">--}}
{{--			<div id="select-default" class="select default">All Categories <i class="far fa-arrow-alt-circle-down"></i></div>--}}
{{--			@foreach($categories as $cat)--}}
{{--				<div class="select option" data-id="{{$cat->id}}">{{$cat->name}}</div>--}}
{{--			@endforeach--}}
{{--		</div>--}}

        <div class="searchchat" style="width: 48%; position: relative;">

            <div id="select-dropdown" class="closed">
                <div id="select-default" class="select default">All Categories <i class="far fa-arrow-alt-circle-down"></i></div>
                @foreach($categories as $cat)
                <div class="select option" data-id="{{$cat->id}}">{{$cat->name}}</div>
                @endforeach
            </div>
        </div>
    </div>
	<input type="hidden" id="content_search_cat" value="" />

</div>

<div class="ml-placessec">
    <div class="row" id="video_search_res">
        ...
    </div>
</div>

<script>
	$('.filters select').each(function() {
		var $this = $(this),
				numberOfOptions = $(this).children('option').length;

		$this.addClass('select-hidden');
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="select-styled"></div>');

		var $styledSelect = $this.next('div.select-styled');
		$styledSelect.text($this.children('option').eq(0).text());

		var $list = $('<ul />', {
			'class': 'select-options'
		}).insertAfter($styledSelect);

		for (var i = 0; i < numberOfOptions; i++) {
			$('<li />', {
				text: $this.children('option').eq(i).text(),
				rel: $this.children('option').eq(i).val()
			}).appendTo($list);
		}

		var $listItems = $list.children('li');

		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.select-styled.active').not(this).each(function() {
				$(this).removeClass('active').next('ul.select-options').hide();
			});
			$(this).toggleClass('active').next('ul.select-options').toggle();
		});

		$listItems.click(function(e) {
			e.stopPropagation();
			$styledSelect.text($(this).text()).removeClass('active');
			$this.val($(this).attr('rel'));
			$list.hide();
			// console.log($this.val());
            searchVideo();
		});

		$(document).click(function() {
			$styledSelect.removeClass('active');
			$list.hide();
		});

	});

    $(document).ready(function() {

    	// $("#content_sorting").change(function(){
    	// 	console.log('sorting...')
		// 	searchVideo();
		// })


	$('#select-default').bind("click", toggle);

	function toggle() {
		if ($('#select-dropdown').hasClass('open')) {
			collapse();
		} else {
			expand();
		}
	}
	function expand() {
		$('#select-dropdown').removeClass('closed').addClass('open');

		options = $('.searchchat .select');

		options.each(function(index) {
			var layer = options.length - index;
			$(this).css("top", 50 * index + "px");
			$(this).css("width", 200);
			$(this).css("margin-left", 0);
		});
	}
	function collapse() {
		$('#select-dropdown').removeClass('open').addClass('closed');

		options = $('.searchchat .select');

		options.each(function(index) {
			var layer = options.length - index;
			$(this).css("z-index", layer);
			$(this).css("top", 0 * index + "px");
			$(this).css("width", 200 - 2 * index);
			$(this).css("margin-left", 0 + index);
		});
	}

	$('.option').bind("click", select);

	function select() {
		if ($('#select-dropdown').hasClass('open')) {
			var selection = $(this).text();
			$('#select-default').text(selection);
			var data = $(this).data("id");

			window.dropdown = data;
			console.log('searching cat.. ', window.dropdown);
            $('#content_search_cat').val(window.dropdown);
            searchVideo();

			collapse();
		} else {
			expand();
		}
	}

	collapse();
});
</script>


<style>
    .dot {
        height: 22px;
        width: 22px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }

    .dot-small {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }
</style>
<?php /*

<div class="col-md-3 no-float col-md-3half" style="padding-right: 0px;">
    <div class="info-box-left" style="margin:10px 10px 10px 10px;overflow: scroll;">
        <h2>Feed {{env('APP_NAME', '')}}</h2>

        <div class="form-group">
            <div class="col-md-5">SORT FEED</div>
            <div class="col-md-7">
                <?php
                foreach($gci_tags as $tag){
                    echo '<span onclick="searchByTag(\''.$tag['id'].'\')" style="background-color: '.$tag['tag_color'].'" class="dot"></span>';
                } ?>
</div>
</div>
<div class="form-group">
    <div class="col-md-4" style="margin:0px;padding: 0px;">
        <input type="text" class="form-control" aria-describedby="nameHelp" name="search_text" id="search_text" placeholder="Search">
    </div>
    <div class="col-md-4" style="padding-right: 0px;">
        <select class="form-control" id="content_search_cat">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4" style="padding-right: 0px;padding-left: 10px;">
        <buttonc class="btn btn-primary" onclick="searchVideo()">Search</buttonc>
        <buttonc class="btn btn-primary" onclick="resetSearch()">Reset</buttonc>
    </div>
</div>
<div class="form-group">
    RECENT
</div>

<div class="form-group" style="height: 100%; " id="video_search_res">
</div>
</div>
</div>
<style>
    .dot {
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin: 2px;
        cursor: pointer;
    }

    .inactive_link {
        cursor: pointer;
    }

</style>

*/ ?>
