/**
 * Created by gerardo on 05/03/18.
 */


$(window).resize(function() {

    var w = $(window).width();
    var r = 1.770491803;

    if (w <= 767) {
        $('#home-slider').css('width', w - 90);
        $('#slider').height(Math.round($('#home-slider').width()/r));
        $('#series-messages #center').css({ 'min-width' : '' });

    }

});

var animateWrapperHeight = '428px';
var $animateWrapper = null;
$(document).ready(function() {
    $animateWrapper = $('.animate-wrapper');
    // animateWrapperHeight = $animateWrapper.height();
    // $animateWrapper.height(0);

});

$(function(){

    var w = $(window).width();
    var r = 1.770491803;
    var mobile_menu = false;

    $('.menu-button').on('tap',function() {

        if (mobile_menu === false) {
            //$animateWrapper.transition({ height: animateWrapperHeight });
            $animateWrapper.addClass('open');
            mobile_menu = true;
        } else {
            //$animateWrapper.transition({ height: '0px' });
            $animateWrapper.removeClass('open');
            mobile_menu = false;
        }
        return false;

    });

    if (w >= 768) {
        $('#home-slider').css('width', 540);
        $('#slider').height(Math.round($('#home-slider').width()/r));
    } else if ( w <= 767) {
        $('#home-slider').css('width', w - 90);
        $('#slider').height(Math.round($('#home-slider').width()/r));

        $('#series-messages #center').css({ 'min-width' : '' });
    }

    $(".photo-list a:nth-child(4n)").css("marginRight", "0");
    $(".gallery").colorbox({rel:'gallery', transition:"none", width:"75%", height:"75%"});

    $(".vimeo").colorbox({iframe:true, innerWidth:580, innerHeight:326});
    $(".vimeo-baptism").colorbox(
        {
            inline:true,
            width:620,
            height:480,
            onLoad: function() {
                var $el = $.colorbox.element(); // the colorbox link
                var $videoDiv = $( $el.attr('href') );
                var vimeoUrl = $videoDiv.find('a.vimeo-url').attr('href');

                //var $vimeoIframe = $("<iframe>").attr( { src: vimeoUrl, frameBorder: 0, width: 580, height: 326 } );
                var $vimeoIframe = $("<iframe>").attr( { src: vimeoUrl, frameBorder: 0, width: 580, height: 326, 'webkitAllowFullScreen' : 'true', 'mozallowfullscreen' : 'true', 'allowFullScreen' : 'true'} ); // 11/02/2017 CB - Allow for fullscreen video

                $videoDiv.find( ".video-embed" ).html($vimeoIframe);

                ///console.log('I am loaded, my video element is ['+videoDivId+'] and want to show '+vimeoUrl)
            }
        }
    );

    // Detail Bar Conditionals

    if ( w <= 767 && $('.details-bar h4').siblings().size() > 0 ) {
        $(this).css({'margin-bottom' : '10px'});
        $('.details-bar .sub-title').css({'margin-bottom' : '10px'});
    } else {
        $('.details-bar h4').css({'margin-bottom' : '0px'});
    }

});



var NPM = NPM || {};

NPM.bannerLoaded = false;
NPM.banner_data = Backbone.Model.extend();

NPM.banner_collection = Backbone.Collection.extend({
    model: NPM.banner_data,
    parse: function(response) { return response.banners; },
    url: function(){ return NPM.options.banner_api_url; }
});

NPM.banner_info = new NPM.banner_collection;

NPM.banner_info.bind('reset',function(e){

    if(!NPM.bannerLoaded)
    {
        var path2check = window.location.pathname;
        /*
         * The logic here is to check the most specific banner segment first, then work our way back to the most open, e.g. "/"
         */
        var matched = false;
        do {
            NPM.banner_info.each(function(banner){
                if (!matched) {
                    var bannerJSON = banner.toJSON();
                    //console.log('checking segment "'+bannerJSON.segment+'" against "'+path2check+'"');
                    // strip off trailing slashes
                    var theBanner = bannerJSON.segment.replace(/\/$/, '');
                    var thePath = path2check.replace(/\/$/,'');
                    if(theBanner == thePath)
                    {
                        var bannerCount = bannerJSON.banners.length;
                        var randNum = Math.round(Math.random()*(bannerCount-1));
                        var bannerImage = bannerJSON.banners[randNum];
                        //console.log('setting banner to '+bannerImage);
                        if(bannerImage) {
                            $('#header').css({backgroundImage:'url("'+bannerImage+'")'});
                            matched = true; // have to do this b/c you can't break out of .each()
                        }
                    }
                }
            });
            if (path2check != "/") {
                var p = path2check.split("/");
                var lastSegment = p.pop();
                //console.log('got rid of '+lastSegment);
                path2check = p.join("/");
                if (path2check == "") path2check = "/";
            }
        } while (!matched && path2check.length > 0)

        NPM.bannerLoaded = matched; // what to do if it's not??

    }
});

NPM.initBanner = function(params) {

    var defaults = {
        banner_api_url:		'/api/bc/banner_options.json',
        banner_json:		{"banners":[]},
        banner_json_cache_age: 0,
        banner_json_cache_expiry: 300,
    };

    NPM.options = _.defaults(params,defaults);


    NPM.bannerJSON = NPM.options.banner_json;
    if(NPM.bannerJSON.banners.length > 0)
    {
        NPM.banner_info.reset(NPM.bannerJSON.banners);
        if (NPM.options.banner_json_cache_age > NPM.options.banner_json_cache_expiry) {
            NPM.banner_info.fetch();
        }
    } else {
        NPM.banner_info.fetch();
    }

};
