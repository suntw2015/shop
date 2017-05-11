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

    productInfo:{},

    productCategoryIndex:{},

    shopCarList:{},

    init:function(){
        this.initDOM();
        this.initEvent();
    },

    setProductData:function(data){
        for(i in data){
            pid = parseInt(data[i]['id']);
            name = data[i]['name'];
            price = parseInt(data[i]['price']);

            this.productInfo[pid] = {'id':pid,'name':name,'price':price};
        }
    },

    setProductCategoryIndexData:function(data){
        this.productCategoryIndex = data;
    },

    initDOM:function(){
        this.context.categoryList   = $("#categoryList");
        this.context.productList    = $("#productList");
        this.context.shopCar        = $("#shopCar");
        this.context.mask           = $("#mask");
        this.context.shopCarList    = $("#shopCarList");
        this.context.productItem    = $(".cartbutton");
        this.context.totalPrice     = $("#totalPrice");
        this.context.submit         = $("#submit");
        this.context.emptyShopCar   = $("#emptyShopCar");
        this.context.productScroll  = $("#productList").find(".scroller");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.categoryList.find("li").bind("click",this.categoryClick.toEventHandler(this));
        this.context.shopCar.bind("click",this.shopCarClick.toEventHandler(this));
        this.context.mask.bind("click",this.maskClick.toEventHandler(this));
        this.context.productItem.bind("click",this.productItemClick.toEventHandler(this));
        this.context.emptyShopCar.bind("click",this.emptyShopCar.toEventHandler(this));
        this.context.submit.bind("click",this.submitClick.toEventHandler(this));
        // this.context.productScroll.bind("scroll",this.adjustScroll.toEventHandler(this));
    },

    categoryClick:function(e){
        this.scrollEnable = false;

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

        var top = parseFloat($("#productList").find("dl[data-category="+categoryId+"]").position().top);
        var current = parseFloat($("#productList").find(".scroller").scrollTop());
        $("#productList").find(".scroller").scrollTop(current + top);
    },

    adjustScroll:function(){
        var categoryIndex = -1; 
        $("#productList").find("dl").each(function(){
            var category = parseInt($(this).data("category"));
            var top = $(this).position().top;
            if(category != NaN && category >= 0){
                if(top <= 20){
                    categoryIndex = category;
                }
            }
        });

        if(categoryIndex != -1){
            this.context.categoryList.find(".menucategory-JnDmc").removeClass("menucategory-JnDmc");
            this.context.categoryList.find("li[data-id="+categoryIndex+"]").addClass("menucategory-JnDmc");
        }
    },

    shopCarClick:function(){
        this.adjustShopCarList();
        this.context.mask.show();
        this.context.shopCarList.show();
    },

    adjustShopCarNum:function(type){
        var count = parseInt(this.context.shopCar.attr("attr-quantity"));
        switch(type){
            case 'minus':
                if(count > 0){
                    count --;
                }
                break;
            case 'plus':
                count ++;
                break;
            default:
                break;
        }
        this.context.shopCar.attr("attr-quantity",count);
    },

    maskClick:function(){
        this.context.mask.hide();
        this.context.shopCarList.hide();
    },

    productItemClick:function(e){
        var ele = this.EventEle(e);
        if(ele.is("use")){
            ele = ele.parent().parent();
        }else if(ele.is("svg")){
            ele = ele.parent();
        }

        var tag = ele.attr("tag");
        if(tag == undefined){
            return false;
        }

        var itemNode = ele.parents(".cartbutton");
        var pid = itemNode.data("id");
        var itemCount = itemNode.find("span[tag=count]");
        var count = parseInt(itemCount.text());
        var stock = itemNode.data("stock");
        switch(tag){
            case 'minus':
                if(count == 1){
                    itemNode.find("a[tag=minus]").hide();
                    itemCount.hide();
                }
                if(itemNode.find("a[tag=plus]").is(":hidden")){
                    itemNode.find("a[tag=plus]").show();
                }
                itemCount.text(count-1);
                this.adjustShopCar("minus",pid);
                this.adjustShopCarNum("minus");
                break;
            case 'plus':
                if(count == stock){
                    // alert("已经达到该商品最大库存");
                    return false;
                }
                if(itemNode.find("a[tag=minus]").is(":hidden")){
                    itemNode.find("a[tag=minus]").show();
                    itemCount.show();
                }
                itemCount.text(count+1);
                this.adjustShopCar("plus",pid);
                this.adjustShopCarNum("plus");
                break;
            default:
                break;
        }
    },

    adjustShopCar:function(type,pid){
        switch (type){
            case 'plus':
                if(this.shopCarList[pid] == undefined){
                    this.shopCarList[pid] = {"id":pid,"name":this.productInfo[pid]['name'],"count":1,"price":this.productInfo[pid]['price'],"total_price":this.productInfo[pid]['price']};
                }else{
                    this.shopCarList[pid]['count'] += 1;
                    this.shopCarList[pid]['total_price'] += this.productInfo[pid]['price'];
                }
                break;
            case 'minus':
                this.shopCarList[pid]['count'] -= this.shopCarList[pid]['count'] > 0 ? 1 : 0;
                this.shopCarList[pid]['total_price'] = this.shopCarList[pid]['count'] * this.shopCarList[pid]['price'];
                break;
            default:
                break; 
        }

        var categoryIndex = this.productCategoryIndex[pid];
        this.adjustCategoryNum(type,categoryIndex);

        var totalPrice = 0;
        for(i in this.shopCarList){
            totalPrice += parseInt(this.shopCarList[i]['total_price']);
        }

        if(totalPrice > 0 && this.context.submit.hasClass("cartview--ijcs")){
            this.context.submit.removeClass("cartview--ijcs");
        }else if(totalPrice <= 0 && !this.context.submit.hasClass("cartview--ijcs")){
            this.context.submit.addClass("cartview--ijcs");
        }

        this.context.totalPrice.text(totalPrice);
    },
    adjustCategoryNum:function(type,id){

        var count = this.context.categoryList.find("li[data-id="+id+"]").find("span[tag=count]").text();
        if(count == '' || count == undefined){
            count = 0;
        }else{
            count = parseInt(count);
        }
        switch(type){
            case 'minus':
                if(count > 1){
                    this.context.categoryList.find("li[data-id="+id+"]").find("span[tag=count]").text(count-1);
                }else if(count == 1){
                    this.context.categoryList.find("li[data-id="+id+"]").find("span[tag=count]").text('');
                }
                break;
            case 'plus':
                this.context.categoryList.find("li[data-id="+id+"]").find("span[tag=count]").text(count+1);
                break;
            default:
                break;
        }
    },
    adjustShopCarList:function(){
        var tpl = '';
        for(i in this.shopCarList){
            var item = this.shopCarList[i];
            if(item['count'] == 0){
                continue;
            }

            tpl += this.createShopCarNode(item['name'],item['total_price'],item['count']);
        }

        this.context.shopCarList.find("li").remove("li");
        this.context.shopCarList.find("ul").append(tpl);
    },
    createShopCarNode:function(name,price,count){
        var tpl = '';
        tpl += '<li class="cartview-17WwB">';
        tpl += '<span class="cartview-2eWUL">';
        tpl += '<em class="cartview-5hJ9d">'+name+'</em> ';
        tpl += '<p class="cartview-1urbT"> </p>';
        tpl += '</span> ';
        tpl += '<span class="cartview-M-60p">'+price+'</span> ';
        tpl += '<span class="cartview-yTaX3">';
        tpl += '<span class="cartbutton-2tycR">';
        // tpl += '<a href="javascript:"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-add"></use></svg></a> ';
        tpl += '<span class="cartbutton-2OSi7">×'+count+'</span> ';
        // tpl += '<a href="javascript:"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-minus"></use></svg></a>';
        tpl += '</span>';
        tpl += '</span>';
        tpl += '</li>';

        return tpl;
    },
    emptyShopCar:function(){
        this.shopCarList = {};
        this.adjustShopCarList();
        this.context.submit.addClass("cartview--ijcs");
        this.context.totalPrice.text(0);
        this.context.shopCar.attr("attr-quantity",0);
        this.context.productItem.each(function(){
            $(this).find("a[tag=minus]").hide();
            $(this).find("span[tag=count]").text(0);
        });
        this.context.categoryList.find("span[tag=count]").each(function(){
            $(this).text('');
        })
    },
    submitClick:function(){
        if(this.context.submit.hasClass("cartview--ijcs")){
            return false;
        }

        $.post("/order/order",this.shopCarList,function(res){
            if(res.code == 0){
                location.href = res.data;
            }else if(res.code == -100){
                location.href = '/user/login'
            }else{
                alert(res.msg);
            }
        });
    }
};

$(document).ready(function(){
    shopPage.init();
    shopPage.setProductData(product);
    shopPage.setProductCategoryIndexData(productCategoryIndex);
});