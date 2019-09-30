<div class="openfilters">
    <span>
        <i class="fas fa-search maginify-glass" ></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
<div class="mlfilter-sec fakeScroll fakeScroll--inside" style="background: #d5d5ed;">
    <div class="mltitle">
        <h3>Advanced Search</h3>
        <i class="far fa-times-circle closefilter"></i>
    </div>

    <div class="mfilterform2">
        <form>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mlfield">
                        <input type="text" placeholder="Location" id="ads_location" />
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mlfield half">
                        <select class="selectbox" id="ads_category">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mlfield">
                        <input id="docalendar" type="text" placeholder="Start Date" />
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mlfield">
                        <input id="docalendar2" type="text" placeholder="End Date" />
                        <i class="fa fa-calendar-alt"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="mfilterform2">
        <form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="mlfield s2">
                        <input type="text" id="ads_keyword" placeholder="Keywords?" />
                        <i class="fa fa-tags"></i>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mlfield s2" style="margin-bottom:45px;">

                        <select id="ads_intentions" class="selectbox" placeholder="Community Intentions">
                            <option value="">All Community Intentions</option>
                            <?php
                            foreach($gci_tags as $tag){
                                echo '<option value="'.$tag['id'].'">'.$tag['tag'].'</option>';
                            } ?>

                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mlfield s2" style="margin-bottom:30px;">
                        <select class="selectbox" id="ads_sorting_tag">
                            <option value="">All Sorting Tags</option>
                            @foreach($sorting_tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->tag}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="tags-sec">
                        <div class="mltags">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="c-label"><input class="exchange_for" value="2" name="cb" id="1" type="checkbox"><label for="1">Service</label></p>
                                    <p class="c-label"><input class="exchange_for" value="1" name="cb" id="2" type="checkbox"><label for="2">Opportunity</label></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="c-label"><input class="exchange_for" value="service" name="cb" id="4" type="checkbox"><label for="4">Sponsored</label></p>
                                    <p class="c-label"><input class="exchange_for" value="service" name="cb" id="3" type="checkbox"><label for="3">User-Submitted</label></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <button type="button" onclick="advance_search()">Search <i class="flaticon-magnifying-glass"></i></button>
        </form>
    </div>
</div>

<script>
    $('.mlfilter-sec select').each(function() {
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
            //console.log($this.val());
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });

</script>
