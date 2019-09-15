<script>
    //add a new style 'foo'
    $.notify.addStyle('foo', {
        html:
            "<div>" +
            "<div class='clearfix'>" +
            "<div class='title' data-notify-html='title'/>" +
            "<div class='buttons'>" +
            // "<button class='no'>Cancel</button>" +
            // "<button class='yes' data-notify-text='button'></button>" +
            "</div>" +
            "</div>" +
            "</div>"
    });
</script>

@if(session()->has('message'))
<div class="alert alert-success">
    <script>
        $.notify({
            title: '<?php echo session()->get('message') ?>',
            button: 'Confirm'
        }, {
            style: 'foo',
            autoHide: true,
            clickToHide: true
        });
    </script>
</div>
@endif
<style>
    .notifyjs-foo-base {
        opacity: 0.85;
        /*width: 400px;*/
        background: #27ae60;
        padding: 5px;
        border-radius: 10px;
        height: 50px;
        color: #fff;
    }

    .notifyjs-foo-base .title {
        /*width: 100px;*/
        float: left;
        margin: 10px 0 0 10px;
        text-align: right;
    }

    .notifyjs-foo-base .buttons {
        width: 70px;
        float: right;
        font-size: 9px;
        padding: 5px;
        margin: 2px;
    }

    .notifyjs-foo-base button {
        font-size: 9px;
        padding: 5px;
        margin: 2px;
        width: 60px;
    }
</style>