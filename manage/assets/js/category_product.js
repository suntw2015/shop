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

    shopCarList:{},

    init:function(){
        this.initDOM();
        this.initEvent();
    },

    initDOM:function(){
        this.context.cid            = $("#cid");
        this.context.name           = $("#name");
        this.context.save_btn       = $("#save");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.save_btn.bind("click",this.saveButtonClick.toEventHandler(this));
        $(".delete").bind("click",this.deleteButtonClick.toEventHandler(this));
    },

    saveButtonClick:function(){
        var cid  = this.context.cid.val();
        
        var pids = [];
        $("input[name=product]:checked").each(function(){
            pids.push($(this).val());
        })

        if(pids.length == 0){
            alert("请选择要关联的产品");
            return false;
        }

        pids = pids.join(",");

        $.post("/category_product/do_update",{"cid":cid,"pids":pids},function(res){
            if(res.code == undefined){
                alert("服务器错误，请稍后再试");
                return;
            }

            if(res.code != 0){
                alert(res.msg);
                return;
            }

            alert(res.data);
            window.location.href = "/category_product/index";
        });
    },
    deleteButtonClick:function(e){
        var ele = this.EventEle(e);
        var cid = ele.data('cid');
        $.post('/category_product/delete',{'cid':cid},function(res){
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
    shopPage.init();
});