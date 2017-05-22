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

var addressPage = {
    context:{},

    init:function(){
        this.initDOM();
        this.initEvent();
        this.hashChangeFunction();
    },

    initDOM:function(){
        this.context.addressSelectBox = $("#address-select-box");
        this.context.addressCreateBox = $("#address-create-box");
        this.context.orderBox = $("#orderBox");
        this.context.titleBar = $("#titleBar");

        this.context.addressCreateConfirm = $("#address_create_confirm");

        this.context.orderAddressSelect = $("#order_address_select");
        this.context.orderAddressRecevName = $("#order");
    },

    EventEle: function (e) {
        return $(e.target || e.srcElement);
    },

    initEvent:function(){
        $(window).bind('hashchange',this.hashChangeFunction.toEventHandler(this));
        this.context.addressCreateConfirm.bind('click',this.addressCreateConfirmClick.toEventHandler(this));
        $(".form-radio").bind('click',this.formRadioClick.toEventHandler(this));
        this.context.orderAddressSelect.bind('click',this.orderAddressSelectClick.toEventHandler(this));
        this.context.addressSelectBox.bind('click',this.addressSelecte.toEventHandler(this));
    },

    hashChangeFunction:function(){
        var hash = window.location.hash.match('[a-zA-Z_]+');
        if(hash == null){
            this.showPage('main');
            return;
        }

        switch(hash.toString()){
            case 'address':
                this.showPage('address_select');break;
            case 'address_create':
                this.showPage('address_create');break;
            case 'address_edit_':
                id = window.location.hash.match('[0-9]+');
                this.showPage('address_edit',id);
                break;
            default:
                this.showPage('main');break;
        }
    },

    showPage:function(type,param){
        var title = '确认订单';

        var orderBoxStatus = type == 'main' ? 'block' : 'none';
        var addressSelectStatus = type == 'address_select' ? 'block' : 'none';
        var addressCreateStatus = type == 'address_create' ? 'block' : 'none';
        var addressUpdateStatus = type == 'address_edit' ? 'block' : 'none';

        if(addressSelectStatus == 'block'){
            title = '选择地址';
        }else if(addressCreateStatus == 'block'){
            title = '添加地址';
        }else if(addressUpdateStatus == 'block'){
            title = '修改地址';
        }

        //地址列表
        if(addressSelectStatus == 'block'){
            $.get('/address/get',{},function(res){
                if(res.code == 0){
                    var tpl = '';
                    for(i in res.data){
                        tpl += '<div data-v-2fb3eec0="" class="addresscard" data-v-5baf0b50="">';
                        tpl += '<div data-v-2fb3eec0="" class="addresscard-body">';
                        tpl += '<p data-v-2fb3eec0="" class="addresscard-title">';
                        tpl += '<span data-v-2fb3eec0="" class="username">'+res.data[i].name+'</span>';
                        tpl += '<span data-v-2fb3eec0="" class="gender">'+res.data[i].sex+'</span>';
                        tpl += '<span data-v-2fb3eec0="" class="phone">'+res.data[i].phone+'</span>';
                        tpl += '</p>';
                        tpl += '<p data-v-2fb3eec0="" class="addresscard-address">';
                        tpl += '<span class="address-tag-2HUG1_0 address-tag-23jXi_0 tag" data-v-2fb3eec0="">'+res.data[i].tag+'</span>';
                        tpl += '<span data-v-2fb3eec0="" class="address-text address">'+res.data[i].address+'</span>';
                        tpl += '</p>';
                        tpl += '</div>';
                        // tpl += '<div data-v-2fb3eec0="" class="addresscard-edit" data-id="'+res.data[i].id+'">';
                        // tpl += '<img data-v-2fb3eec0="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAmCAYAAACsyDmTAAAAAXNSR0IArs4c6QAABYVJREFUWAm9mAtsU2UUgOlrQ8g0bALZhgtBZTUxwfhMSIju5V5oJJJNEpOyV7chokyNTtFoZDofEUHZu2s2GcT5yDBzCEyLi1GDxsQHshk1qSaKjy4usskebf1O09uUu9t2bL38ydn/Ovecr+c////fO9Oii1j8fr8xPT29oLi4eGl/f/8fWq4NWoN6jLlcLvPIyEgfUMUGg8GPj501NTV71b6M6gG9+sPDw61BmDHxQfvV5ubmarW/iwLU0tLyFI7LicyE0WjMo71dQOg3t7a22qStFN2BcNhANJ7BuRen99jt9i9Yqib6DzFuQBwAlypAuuZQU1NTIY7fx5n4GaytrZXohApL9gSd3cgMepsBPawbEL96Hb/ehbNlQoBDSeQGnD4pfaUA1UD7ceanqPN0AWKZrD6fbwgHy3H0LvUq4G4OQtUD9QJjoQKU7LYdzJ+Iew51dnauAeZDHCxHjiQnJ29B1uPsW8kZxp5vb2+/jzpQOjo6kmncGOyOxTVCwFwxNTU1hOPVALgSExOLysrKzokzomZh/BRyNV0/u62M2kX/KGKl7WYsJ25A/OqVXq9XYNYC8xlRub2kpOQsjkJlYGAg0e12/8BABjo+dP+mvQL5JiEhobCiouK3uCxZV1dXyszMzGAQ5iucFaphhKqoqGiSKFxD8090xfcKdD9JSkraIDCiY5Y/CyksxWUTExNHsXEtxk8h+dXV1YHTOILdK9ExAyTT7oyMjFwBVXQXFKHu7u6lJPAAxm5AfiRncoGRZdAsbW1tawE5jiQDddhqtV4VDiMPzRvI6XQuHh8ffw8b65FAQpLAZ8SoVmFrr5bdB8xKYI4RmdKsrKwZte68lkx2zOTk5NsYy8b470gOkflFbVzpA5NOW2BWoTuEbFJHRtG94Aj19vaaMHwQkdcIWR5Zpp8Ug+qaZZXEHWR8DfVJi8WyEf0JtZ7SvyAgIAwej8dJvRnj/8jNzan7vWJMXff09CxjWSVnrOh/zW4qYDf9q9YL75vCO7HaaWlpLRgvR++s2WzO5+b+MtIzDocjid13nPnrkdMkfLbNZvNE0lfG5xwh8uYVklJeqP4zmUwbq6qqPleMqGt0l3Biyy1/E/Izh15ueXn5X2o9rf6cgLi5nwVmJ2GfAmYTkflYy5iMyWlMFPtobkB+JWeylUNP5mOVmED82sdwsAtD8s5SCowcgppF3pu5GnrRl/eeM+jnVFZWujWVIwxGvcuIzP0Y38ezPozfSwIfimBnkey+0dHRHvTl7c9DZG4D5rtI+pHGI0YImAoe2guIH7FHgwHCAEyHwKA7Jgk/HxiB1NxlwGzBuJN5Iw4eAKZFlCOV1NTU/ehXoTvOUVDAsp6MpBtrfNZJTc7cRQJ38yC2jfUcYq9FMwL8i8BsA+YcCX8nu+/TaPqx5s5bMi6/fIy/yUNmHOwGpjGaAa6Ep9F/BN1p9O4G5qNo+nOZCyU1MLfygnWEhy4hMnuAqYtmgMg8DMxLwHjRl933TjT9uc4FgFimWzB+AlmMgzZyZtYXZbhBYLahu58xH8u0FZg3wucX0jYSmevImWMCI4ao5WALRU5tnGXaytjrMk5kauMJE7AJjNw3lyKnZYBiA1LOnlkFmBIiKNtbgOtY1rZZSgscMGL8crHBr12HBH45kNtZlufCbdO/A5gD6MtRsYuv0D3h8/Fqh3YZv3aa8O/AcJcYx3E9EI9KmzqP/luIhW4jMPK1qUsJAYl1IuBPSUmpoJavTYFqJOFfpimXZSKyD5h6at3KeUDihc8Xr3xt0gxcokDVIUuAdLD7HtSNJGh4FpCMAyUf/vI/nWlgJIEPsqR2iSBtXUvo6mAHaToDoi8zM9NG7dOVJGhcM0KKYyA+YPk0P1cUnXjX/wPDuHWDQzow1QAAAABJRU5ErkJggg==">';
                        // tpl += '</div>';
                        tpl += '</div>';
                    }
                    $(".addressview-exceed").html(tpl);
                }
            });
        }

        //编辑地址
        if(addressUpdateStatus == 'block'){
            $.get('/address/update?id='+param,function(res){
                $("#address-update-box").remove();
                $("#root").append(res.data);
                $("#address-update-box").css('display','block');
            });
        }else{
            $("#address-update-box").remove();
        }
        
        this.context.addressSelectBox.css('display',addressSelectStatus);
        this.context.addressCreateBox.css('display',addressCreateStatus);
        this.context.orderBox.css('display',orderBoxStatus);
        this.context.titleBar.text(title);
    },

    addressCreateConfirmClick:function(){
        var name = $("#address_create_name").val();
        var sex = $("span[name=address_create_sex].checked").attr('value');
        var phone = $("#address_create_phone").val();
        var address = $("#address_create_address").val();
        var tag = $("#address_create_tag").val();
        if(name == ''){
            alert('姓名不能为空');return;
        }
        if(sex == undefined){
            alert('性别不能为空');return;
        }
        if(phone == ''){
            alert('手机号不能为空');return;
        }
        if(address == ''){
            alert('地址不能为空');return;
        }

        $.post('/address/do_create',{'name':name,'sex':sex,'phone':phone,'address':address,'tag':tag},function(res){
            if(res.code == undefined){
                alert('服务器错误，请稍后再试');
                return;
            }

            if(res.code != 0){
                alert(res.msg);return;
            }

            history.go(-1);
        });
    },

    formRadioClick:function(e){
        var ele = this.EventEle(e);
        if(ele.hasClass('radio-icon')){
            ele = ele.parent();
        }
        var name = ele.find('span').attr('name');
        ele.parent().find('span[name='+name+']').removeClass('checked');
        ele.find('span').addClass('checked');
    },

    orderAddressSelectClick:function(){
        location.hash = 'address';
    },

    // 选择地址
    addressSelecte:function(e){
        var ele = this.EventEle(e);
        
        if(ele.parents('.addresscard-body').length){
            ele = ele.parents('.addresscard-body');
        }

        if(ele.hasClass('addresscard-body')){
            var recev_name = ele.find("span.username").text();
            var sex = ele.find("span.gender").text();
            var phone = ele.find("span.phone").text();
            var tag = ele.find("span.tag").text();
            var address = ele.find("span.address").text();

            var tpl = '<h2 data-v-74568ee4="" class="address-name">';
            tpl += '<b data-v-74568ee4="" id="order_recev_name">'+recev_name+'</b>';
            tpl += '<span data-v-74568ee4="" id="order_phone">'+phone+'</span>';
            tpl += '</h2>';
            tpl += '<p data-v-74568ee4="" class="address-detail" id="order_address">';
            tpl += '<span class="address-tag-2HUG1_0 address-tag-23jXi_0" data-v-74568ee4="" id="order_tag">'+tag+'</span>'+address;
            tpl += '</p>';
            tpl += '<svg data-v-74568ee4="">';
            tpl += '<use data-v-74568ee4="" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right"></use>';
            tpl += '</svg>';
            this.context.orderAddressSelect.find(".address-item").html(tpl);
            history.go(-1);
        }

        if(ele.parents('.addresscard-edit').length){
            ele = ele.parents('.addresscard-edit');
        }
        
        if(ele.hasClass('addresscard-edit')){
            var id = ele.data('id');
            location.hash = "address_edit_"+id;
        }
    }
};

$(document).ready(function(){
    addressPage.init();
});