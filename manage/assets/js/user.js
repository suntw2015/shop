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
        this.context.uid        = $("#uid");
        this.context.username   = $("#username");
        this.context.head_img   = $("#head_img");
        this.context.password   = $("#password");
        this.context.phone      = $("#phone");
        this.context.email      = $("#email");
        this.context.save_btn   = $("#save");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        this.context.save_btn.bind("click",this.saveButtonClick.toEventHandler(this));
    },

    saveButtonClick:function(){
        var uid = this.context.uid.val();
        var username = this.context.username.val();
        var head_img = this.context.head_img.val();
        var password = this.context.password.val();
        var phone = this.context.phone.val();
        var email = this.context.email.val();
        var status = $("input[name=status]:checked").val();
        var role = $("input[name=role]:checked").val();
        
        var url = uid == undefined ? '/user/do_create' : '/user/do_update';

        $.post(
            url,
            {"uid":uid,"username":username,"head_img":head_img,"password":password,"phone":phone,"email":email,"status":status,"role":role},
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
                window.location.href = '/user/index';
        });
    }
};

$(document).ready(function(){
    shopPage.init();
});