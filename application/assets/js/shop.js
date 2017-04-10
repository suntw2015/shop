/**
 * Created by stw on 2016/1/20.
 */

Function.prototype.toEventHandler = function (c) {
    var a = this,
    b = Array.from(arguments),
    c = b.shift();
    return function (d) {
        if (typeof Array.from == "function") {
            return a.apply(c, [d || window.event].concat(b));
        }
    };
};

var shopPage = {
    context:{},

    init:function(){
        this.initDOM();
        this.initEvent();
    },

    initDOM:function(){
        this.context.categoryList   = $("#categoryList");
        this.context.productList    = $("#productList");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.categoryList.find("li").bind("click",this.categoryClick.toEventHandler(this));
    },

    categoryClick:function(e){
        this.context.categoryList.find(".menucategory-JnDmc").removeClass("menucategory-JnDmc");
        var ele = this.EventEle(e);
        var tag = ele.attr("tag");
        if(tag != 'li'){
            return false;
        }
        
        e.preventDefault();
        ele.addClass("menucategory-JnDmc");
    }
};

$(document).ready(function(){
    shopPage.init();
});