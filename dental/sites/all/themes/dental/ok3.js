/**
 * Created by storm on 5/13/14.
 */
function NewOdnaknopka3() {
    this.domain=location.href+'/';
    this.domain=this.domain.substr(this.domain.indexOf('://')+3);
    this.domain=this.domain.substr(0,this.domain.indexOf('/'));
    this.location=false;
    this.url=function(system) {
        var title=encodeURIComponent(document.title);
        var url=encodeURIComponent(location.href);
        switch (system) {
            case 1: return 'http://vkontakte.ru/share.php?url='+url;
            case 2: return 'http://www.facebook.com/sharer.php?u='+url;
            case 3: return 'http://twitter.com/share?text='+title+'&url='+url;
            case 4: return 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='+url;
            case 5: return 'http://connect.mail.ru/share?share_url='+url;
            case 6: return 'http://www.livejournal.com/update.bml?event='+url+'&subject='+title;
            case 7: return 'http://memori.ru/link/?sm=1&u_data[url]='+url+'&u_data[name]='+title;
            case 8: return 'http://bobrdobr.ru/addext.html?url='+url+'&title='+title;
            case 9: return 'http://www.google.com/bookmarks/mark?op=add&bkmk='+url+'&title='+title;
            case 10: return 'http://zakladki.yandex.ru/newlink.xml?url='+url+'&name='+title;
            case 11: return 'http://surfingbird.ru/share?url='+url;
            case 12: return 'http://text20.ru/add/?title=' + title + '&source='+url+'&text='+title;
        }
    }
    this.redirect=function() {
        if (this.location) location.href=this.location;
        this.location=false;
    }
    this.go=function(i) {
        this.location=this.url(i);
    }
    this.init=function() {
        var titles=new Array('&#1042; &#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1077;','Facebook','Twitter','&#1054;&#1076;&#1085;&#1086;&#1082;&#1083;&#1072;&#1089;&#1089;&#1085;&#1080;&#1082;&#1080;','&#1052;&#1086;&#1081; &#1052;&#1080;&#1088;','LiveJournal','Memori','&#1041;&#1086;&#1073;&#1088;&#1044;&#1086;&#1073;&#1088;','&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080; Google','&#1071;&#1085;&#1076;&#1077;&#1082;&#1089;.&#1047;&#1072;&#1082;&#1083;&#1072;&#1076;&#1082;&#1080;','Surfingbird','&#1058;&#1077;&#1082;&#1089;&#1090; 2.0');
        var html='';
        html+='<a href="http://odnaknopka.ru/"><img src="http://odnaknopka.ru/images/blank.gif" width="16" height="16" alt=" #" title="&#1054;&#1076;&#1085;&#1072;&#1050;&#1085;&#1086;&#1087;&#1082;&#1072;" style="border:0;padding:0;margin:0 4px 0 0;background:url(http://odnaknopka.ru/images/panel.png) no-repeat -270px -192px"/></a>';
        for (i=0;i<12;i++) {
            html+='<a href="'+this.url(i+1)+'" onclick="return odnaknopka3.go('+(i+1)+');"><img src="http://odnaknopka.ru/images/blank.gif" width="16" height="16" alt=" #" title="'+titles[i]+'" style="border:0;padding:0;margin:0 4px 0 0;background:url(http://odnaknopka.ru/images/panel.png) no-repeat -270px -'+(i*16)+'px"/></a>';
        }
        document.write(html);
    }
}
odnaknopka3=new NewOdnaknopka3();
odnaknopka3.init();
