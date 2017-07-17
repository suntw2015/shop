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
        this.context.name           = $("#name");
        this.context.cover_img      = $("#cover_img");
        this.context.delivery       = $("#delivery");
        this.context.delivery_fee   = $("#delivery_fee");
        this.context.phone          = $("#phone");
        this.context.notice         = $("#notice");
        this.context.activity_icon  = $("#activity_icon");
        this.context.activity_desc  = $("#activity_desc");
        this.context.save_btn       = $("#save");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.save_btn.bind("click",this.saveButtonClick.toEventHandler(this));
    },

    saveButtonClick:function(){
        var name = this.context.name.val();
        var cover_img = this.context.cover_img.val();
        var delivery = this.context.delivery.val();
        var delivery_fee = this.context.delivery_fee.val();
        var phone = this.context.phone.val();
        var notice = this.context.notice.val();
        var activity_icon = this.context.activity_icon.val();
        var activity_desc = this.context.activity_desc.val();
        var status = $("input[name=status]:checked").val();
        $.post(
            '/shop/do_update',
            {"name":name,
            "cover_img":cover_img,
            "delivery":delivery,
            "delivery_fee":delivery_fee,
            "phone":phone,
            "notice":notice,
            "activity_icon":activity_icon,
            "activity_desc":activity_desc,
            "status":status
        },function(res){
            if(res.code == undefined){
                alert("服务器错误，请稍后再试");
                return;
            }

            if(res.code != 0){
                alert(res.msg);
                return;
            }

            alert(res.data);
            window.location.reload();
        });
    }
};

$(document).ready(function(){
    shopPage.init();
});