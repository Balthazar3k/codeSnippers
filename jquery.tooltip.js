jQuery.fn.extend({
    data: function(){
        var mode = this.attr('tooltip');

        if (typeof mode != 'undefined' && mode.indexOf('ajax:') !== -1 ){
            $('#tooltip').html('Loading...');

            var data;
            var res = mode.split(':')[1];
            var url = res.split('?');
            $.post( url[0], url[1], function(incomming_data){
                $('#tooltip').html(incomming_data);
            });
        } else if (typeof mode != 'undefined' && mode.indexOf('load:') !== -1 ){
            $('#tooltip').html('Loading...');
            $('#tooltip').load(mode.split('load:')[1]);
        } else if (typeof mode != 'undefined' && mode.indexOf('$') !== -1 ){
            $('#tooltip').html('Loading...');
            $('#tooltip').html($(mode.split('$')[1]).html());
        } else {
            return mode;
        }

    },
    tooltip: function(){
        $("<div></div>")
            .attr('id', 'tooltip')
            .css({display:'none', position: 'absolute', zIndex: 2000})
            .appendTo("body");

        var object = $("#tooltip");

        $(this).mouseenter(function(){
            object.html( $(this).data() );
            object.stop(true, true).delay(50).fadeIn(750).dequeue();
        }).mouseleave(function(){
            object.stop(true, true).fadeOut(500);
        }).mousemove( function(event){ 
            var posTop;
            var posLeft;

            var tooltip_width = object.width();
            var document_width = $(window).innerWidth();

            if( (event.pageX+tooltip_width+20) > document_width ){
                posLeft = event.pageX - tooltip_width - 20;
            } else {
                posLeft = event.pageX +20;
            }

            var tooltip_height = object.height();
            var document_height = $(window).innerHeight();

            if( (event.pageY+tooltip_height+20) > document_height ){
                posTop = event.pageY - tooltip_height - 20;
            } else {
                posTop = event.pageY +20;
            }

            object.css({
                top:posTop, 
                left:posLeft
            });
        });
    }
});
