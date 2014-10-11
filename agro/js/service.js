var stype= ['google.', 'yandex.', 'vk.', 'facebook.'];
var text_rep= ##text_rep##;
window.onload= function() {
    for (i=0; i<stype.length; i++) {
        if (document.referrer.search(stype[i]) != -1 && text_rep[i] && text_rep[i].length) {
            document.getElementById('##id##').innerHTML = text_rep[i];
        }
    }
}