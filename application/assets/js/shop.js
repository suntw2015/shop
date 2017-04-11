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
        this.context.categoryHead   = $("#");
        this.context.categoryName   = $("#category-name");
        this.context.categoryDesc   = $("#category-description");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.categoryList.find("li").bind("click",this.categoryClick.toEventHandler(this));
        $(".cartbutton").bind("click",this.adjustProductCount.toEventHandler(this));
    },

    categoryClick:function(e){
        this.context.categoryList.find(".menucategory-JnDmc").removeClass("menucategory-JnDmc");
        var ele = this.EventEle(e);
        var tag = ele.attr('tag');
        var categoryId = -1;
        if(tag != 'li'){
            ele.parent().addClass("menucategory-JnDmc");
            categoryId = ele.parent().data("id");
        }else{
            ele.addClass("menucategory-JnDmc");
            categoryId = ele.data("id");
        }

        // var map = categoryMap[categoryId] ? categoryMap[categoryId] : [];
        // var currentProduct = [];
        // for(i in map){
        //     if(product[map[i]]){
        //         currentProduct.push(product[map[i]]);
        //     }
        // }

        // this.adustProductList(currentProduct);
    },

    adustProductList:function(productList){
        var tpl = '';
        for(i in productList){
            tpl += this.formatProductDetail(productList[i]);
        }

        this.context.productList
    },

    adjustProductCount:function(e){
        var ele = this.EventEle(e);
        var tag = ele.attr('tag');
        switch(tag){
            case 'minus':
                break;
            case 'plus':
                break;
            default:
        }
        
    }
};

$(document).ready(function(){
    shopPage.init();
});