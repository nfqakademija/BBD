var toast_timer;
var scrolled = $(document).scrollTop();
var browser = check_browser();
var transition_time = 200;
var username_max_size = 19;
var username_min_size = 2;
var password_max_size = 30;
var password_min_size = 5;
var transition_time = 200;
var scroll_animation_time = 600;
var toast_show_time = 3000;
var website_index = "/NFQ/web";

function toast(text, status){
    clearTimeout(toast_timer);
    $("#toast").html(text);
    $("#toast_wrapper").css('height','50px');

    if(status == "good")
        $("#toast_wrapper").css('background-color','rgba(43, 190, 43, 0.95)');
    else if(status == "bad")
        $("#toast_wrapper").css('background-color','rgba(175, 25, 25, 0.95)');

    toast_timer = setTimeout(function(){
        $("#toast_wrapper").css('height','0px');
    },toast_show_time);
}

function append_recipes(){
    $(".content_list").html('');
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { append_files: 'true' },
        dataType: 'json',
        success:function(data){
            var recipes = data.recipes;
            for(i = 0; i < recipes.length; i++){
                append_recipe(recipes[i]);
            }
        }
    });
}

function append_recipe(data){
    $(".content_list").append(data);
}

function to_very_top(){
    $("html, body").animate({scrollTop: 0}, scroll_animation_time);
}

function to_very_bottom(){
    $("html, body").animate({scrollTop: $(document).height()}, scroll_animation_time);
}


$(window).scroll(function(){
    scrolled = $(document).scrollTop();
    if(scrolled > 800)
        toast_top('show');
    else
        toast_top('hide');
});

function getDocHeight(){
    return Math.max(
        Math.max(document.body.scrollHeight, document.documentElement.scrollHeight),
        Math.max(document.body.offsetHeight, document.documentElement.offsetHeight),
        Math.max(document.body.clientHeight, document.documentElement.clientHeight)
    );
}

function toast_top(display){
    if(display == "show")
        $("#toast_top").fadeIn(transition_time * 2);
    else if(display == "hide")
        $("#toast_top").fadeOut(transition_time * 2);
}

function show_loading(){
    $("#toast_loading").fadeIn(transition_time * 2);
}

function hide_loading(){
    $("#toast_loading").fadeOut(transition_time * 2);
}

function refresh(){
    location.href = location.href;
}


function input_click(type){
    $('#input_' + type).trigger('click');
}

function IsNumeric(input){
    return (input - 0) == input && (input + '').replace(/^\s+|\s+$/g, "").length > 0;
}

function check_browser(){
    var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    var isChrome = !!window.chrome && !isOpera;
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    var agent = 'undefined';
    if(isOpera){
        agent = 'opera';
    }
    if(isFirefox){
        agent = 'firefox';
    }
    if(isSafari){
        agent = 'safari';
    }
    if(isChrome){
        agent = 'chrome';
    }
    if(isIE){
        agent = 'IE';
    }

    return agent;
}



function check(type, amount){
    switch(type){
        case "email":
            var etaposition = amount.indexOf("@");
            var dotposition = amount.lastIndexOf(".")
            var lastEtaPosition = amount.lastIndexOf("@");
            var etaCount = amount.replace(/[^@]/gi, "").length;
            if (etaposition < 1 || dotposition <= etaposition + 2 || dotposition + 2 >= amount.length || etaCount != 1 ){
                return false;
            }else{
                return true;
            }
            break;

        case "password":
            var password_length = amount.length;
            if (password_length > password_max_size || password_length < password_min_size){
                return false;
            }else{
                return true;
            }
            break;

        case "username":
            var username_length = amount.length;
            if (username_length > username_max_size || username_length < username_min_size){
                return false;
            }else{
                return true;
            }
            break;
    }
}

function show_filters(array_of_filters, index){
    $("#filters_zone").append('<div style="display:block;margin-left:210px;" id="container_appender">' + array_of_filters[index] + '</div>');
    $("#container_appender").animate({marginLeft: 0}, transition_time);
    $("#container_appender").fadeIn(transition_time);
    $("#container_appender").attr('id','container_appender_out');
    index++;
    if(index <= array_of_filters.length - 1){
        setTimeout(function(){
            show_filters(array_of_filters, index);
        },transition_time / 100);
    }
}

function filter_start(){
    var filters = [];
    filters[0] = "<div class='filter_element untouchable' id='types' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/types.png');\"></div><div class='filter_element_text'>Tipai</div></div>";
    filters[1] = "<div class='filter_element untouchable' id='characteristics' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/characteristics.png');\"></div><div class='filter_element_text'>Ypatybės</div></div>";
    filters[2] = "<div class='filter_element untouchable' id='times' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/times.png');\"></div><div class='filter_element_text'>Laikai</div></div>";
    filters[3] = "<div class='filter_element untouchable' id='countries' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/countries.png');\"></div><div class='filter_element_text'>Šalys</div></div>";
    filters[4] = "<div class='filter_element untouchable' id='ingredients' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/ingredients.png');\"></div><div class='filter_element_text'>Ingredientai</div></div>";
    filters[5] = "<div class='filter_element untouchable' id='emotions' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/emotions.png');\"></div><div class='filter_element_text'>Nuotaikos</div></div>";
    filters[6] = "<div class='filter_element untouchable' id='celebrations' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/celebrations.png');\"></div><div class='filter_element_text'>Šventės</div></div>";
    filters[7] = "<div class='filter_element untouchable' id='cooking_methods' onclick='filter_category(this.id)'><div class='filter_element_image' style=\"background-image:url('" + website_index + "/images/filters/cooking_methods.png');\"></div><div class='filter_element_text'>Gaminimo būdai</div></div>";

    var config_zone = "<div class='filter_element_go_back untouchable'><div class='go_back untouchable' onclick=\"filter_go_back('all')\"><<</div><div class='go_back untouchable' onclick=\"filter_go_back('one')\"><</div></div>";

    $("#filters_zone").fadeOut(transition_time, function(){
        $("#filters_zone").html('');
        $("#filters_zone").fadeIn(1);
        show_filters(filters, 0);
    });

    $("#config_zone").fadeOut(transition_time, function(){
        $("#config_zone").html(config_zone);
        $("#config_zone").fadeIn(transition_time);
    });


    /*
     $.ajax({
     type: 'POST',
     url: 'ajax.php',
     data: { filter_start: 'true' },
     dataType: 'json',
     beforeSend:function(){
     },
     success:function(data){
     $("#filters_zone").fadeOut(transition_time, function(){
     $("#filters_zone").html(data.filters);
     $("#filters_zone").fadeIn(transition_time);
     });
     $("#config_zone").fadeOut(transition_time, function(){
     $("#config_zone").html(data.config_zone);
     $("#config_zone").fadeIn(transition_time);
     });
     }
     });
     */
}

function filter_category(category){
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { filter_category: category },
        dataType: 'json',
        success:function(data){
            $("#filters_zone").fadeOut(transition_time, function(){
                $("#filters_zone").html(data.filters);
                $("#filters_zone").fadeIn(transition_time);
            });
            $("#config_zone").fadeOut(transition_time, function(){
                $("#config_zone").html(data.config_zone);
                $("#config_zone").fadeIn(transition_time);
            });
        }
    });
}

function content_navigation(type){
    $('.nav_zone_element').removeClass('nav_element_active');
    $("#" + type).addClass('nav_element_active');
    switch(type){
        case "home": location.href = website_index + "/"; break;
        case "profile": location.href = website_index + "/profile"; break;
        case "shoppinglist": location.href = website_index + "/shoppinglist"; break;
        case "random": location.href = website_index + "/random"; break;
        default: location.href = website_index + "/"; break;
    }

}

function filter_go_back(type){
    var config_zone =
        "<div class='filter_element untouchable' onclick='filter_start()'>" +
        "<div class='filter_element_image' id='add'></div>" +
        "<div class='filter_element_text'>Pridėti filtrą</div>" +
        "</div>";

    $("#filters_zone").fadeOut(transition_time, function(){
        $("#filters_zone").html('');
        $("#filters_zone").fadeIn(transition_time);
    });
    $("#config_zone").fadeOut(transition_time, function(){
        $("#config_zone").html(config_zone);
        $("#config_zone").fadeIn(transition_time);
    });

    /*
     $.ajax({
     type: 'POST',
     url: 'ajax.php',
     dataType: 'json',
     data: { filter_back_type: type },
     beforeSend:function(){
     },
     success:function(data){
     $("#filters_zone").fadeOut(transition_time, function(){
     $("#filters_zone").html(data.filters);
     $("#filters_zone").fadeIn(transition_time);
     });
     $("#config_zone").fadeOut(transition_time, function(){
     $("#config_zone").html(data.config_zone);
     $("#config_zone").fadeIn(transition_time);
     });
     }
     });
     */
}

function manipulate_filter(ID){
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: { filter_manipulate: ID },
        success:function(data){
            if(data.status == "removed"){
                $("#indicator_" + ID).removeClass('added');
            }else if(data.status == "added"){
                $("#indicator_" + ID).addClass('added');
            }
            append_recipes();
        }
    });
}

function filter_search_add(ID){
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: { filter_search_add: ID },
        success:function(data){
            append_recipes();
            $("#search_input").val('');
            $("#search_container").html('');
            $("#search_container").css('display','none');
            if(data.filter_level == 0)
                $("#filters_zone").append(data.filter);
        }
    });
}



function filter_delete(ID){
    ID = ID.replace('delete_','');
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        data: { filter_delete: ID },
        beforeSend:function(){
        },
        success:function(data){
            $('#' + ID).remove();
            append_recipes();
        }
    });
}

function filter_selected(ID){
    var classes = ($("#" + ID).attr('class')).split(" ");
    var selected = classes[2];
    if(selected == "selected"){
        $("#" + ID).removeClass('selected');
    }else{
        $("#" + ID).addClass('selected');
    }
}


function search(){
    var value = ($('#search_input').val()).trim();
    value = value.replace(/[-\/\\^$*+?.,()|[\]{}]/g, ' ');
    $.ajax({
        type: 'POST',
        url: 'ajax.php',
        dataType: 'json',
        data: { search: value },
        success:function(data){
            $("#search_container").html('');
            if(data.search_results.length > 0){
                $("#search_container").css('display','block');
            }else{
                $("#search_container").css('display','none');
            }

            for(i = 0; i < data.search_results.length; i++){
                $("#search_container").append(data.search_results[i]);
            }
        }
    });
}

function focus_input(ID){
    $('#' + ID).focus();
}

function last_index(){
    path = $(location).attr('href');
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}

function show_recipe(recipe_ID){
    location.href = website_index + "/recipe/" + recipe_ID;
}

function cook(recipe_ID){
    location.href = website_index + "/cook/" + recipe_ID + "/1";

    //send ajax can keep track of time spent on cooking. starting time
}

function cook_step(recipe_ID, step_ID){
    location.href = website_index + "/cook/" + recipe_ID + "/" + step_ID;

    //send ajax can keep track of time spent on this step cooking.
}

function remember_recipe(recipe_ID){
    var classes = ($("#remember_" + recipe_ID).attr('class')).split(" ");
    var selected = classes[3];
    if(selected == "remembered"){
        $("#remember_" + recipe_ID).removeClass('remembered');
        $("#remember_" + recipe_ID).html('Įsiminti');
    }else{
        $("#remember_" + recipe_ID).addClass('remembered');
        $("#remember_" + recipe_ID).html('Įsiminta');
    }

    //send to server profile that recipe is remebered ajax
}


function search_input_focus(){
    if(!$("#search_input").is(":focus")){
        $("#search_zone").removeClass('unactive_search_zone');
        $("#search_zone").addClass('active_search_zone');
    }
}

function search_input_blur(){
    $("#search_zone").removeClass('active_search_zone');
    $("#search_zone").addClass('unactive_search_zone');
}