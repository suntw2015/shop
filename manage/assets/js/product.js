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

var productPage = {
    context:{},

    shopCarList:{},

    init:function(){
        this.initDOM();
        this.initEvent();
    },

    initDOM:function(){
        this.context.pid    = $("#pid");
        this.context.name   = $("#name");
        this.context.desc   = $("#desc");
        this.context.cover_img   = $("#cover_img");
        this.context.price   = $("#price");
        this.context.stock   = $("#stock");
        this.context.save_btn = $("#save");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.save_btn.bind("click",this.saveButtonClick.toEventHandler(this));
        $(".delete").bind("click",this.deleteButtonClick.toEventHandler(this));
    },

    saveButtonClick:function(){
        var pid = this.context.pid.val();
        var name = this.context.name.val();
        var desc = this.context.desc.val();
        var cover_img = this.context.cover_img.val();
        var price = this.context.price.val();
        var stock = this.context.stock.val();
        var status = $("input[name=status]:checked").val();

        if(!name.length){
            alert('名称不能为空');
            return;
        }

        if(!desc.length){
            alert('描述不能为空');
            return;
        }

        if(!status.length){
            alert('状态不能为空');
            return;
        }
        
        var url = pid == undefined ? '/product/do_create' : '/product/do_update';

        $.post(
            url,
            {"pid":pid,"name":name,"desc":desc,"cover_img":cover_img,"price":price,"stock":stock,"status":status},
            function(res){
                if(res.code == undefined){
                    alert("服务器错误，请稍后再试");
                    return;
                }

                if(res.code != 0){
                    alert(res.msg);
                    return;
                }

                alert(res.data);
                window.location.href = '/product/index';
        });
    },

    deleteButtonClick:function(e){
        var ele = this.EventEle(e);
        var pid = ele.data('id');
        $.post('/product/delete',{'id':pid},function(res){
            if(res.code == undefined){
                alert("服务器错误，请稍后再试");
                return;
            }

            if(res.code != 0){
                alert(res.msg);
                return;
            }

            window.location.reload();
        });
    }
};

$(document).ready(function(){
    productPage.init();
});