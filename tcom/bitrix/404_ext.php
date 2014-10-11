<style>
    body .center {
        float: none;
        width: 100%;
        margin: 0;
    }
    body .left {
        float: none;
        display: none;
    }
    body ul + ul {
        margin-top: 20px !important;
    }
    body .map-table > li {
        display: block;
        float: left;
        min-width: 200px;
    }
</style>

<script>
    $(document).ready(function(){
            colnum= media_col_num();
            map_hfix(colnum);

            $(window).resize(function(){
                $('.map-table>li').removeAttr('style');
                colnum= media_col_num();
                map_hfix(colnum);
            });
    });

</script>