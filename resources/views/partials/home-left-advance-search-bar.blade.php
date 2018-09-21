<div class="openfilters"><img src="/assets/findgo/images/icon2.png" alt="" /><span>Adv Search</span></div>
<div class="mlfilter-sec fakeScroll fakeScroll--inside" style="background: #d5d5ed;">
    <div class="mltitle">
        <h3>Advanced Search</h3>
        <span class="closefilter"><i>+</i></span>
    </div>
    <div class="mfilterform2">
        <form>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mlfield">
                        <input type="text" placeholder="Location" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mlfield">
                        <select class="selectbox">
                            <option>All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}" >{{$cat->name}}</option>
                            @endforeach
                        </select>
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
                        <input type="text" placeholder="Keywords?" />
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mlfield s2">
                        <select class="selectbox" placeholder="Community Intentions">
                            <option value="">All Community Intentions</option>
                            <?php
                            foreach($gci_tags as $tag){
                                echo '<option value="'.$tag['id'].'">'.$tag['tag'].'</option>';
                            } ?>

                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mlfield s2">
                        <select class="selectbox">
                            <option>All Sorting Tags</option>
                            @foreach($sorting_tags as $tag)
                                <option value="{{$tag->id}}" >{{$tag->tag}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="tags-sec">
                        <div class="mltags">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="c-label"><input name="cb" id="1" type="checkbox"><label for="1">Service</label></p>
                                    <p class="c-label"><input name="cb" id="2" type="checkbox"><label for="2">Opportunity</label></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="c-label"><input name="cb" id="4" type="checkbox"><label for="4">Sponsored</label></p>
                                    <p class="c-label"><input name="cb" id="3" type="checkbox"><label for="3">User-Submitted Collaborations</label></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <button type="submit">Search <i class="flaticon-magnifying-glass"></i></button>
        </form>
    </div>
</div>