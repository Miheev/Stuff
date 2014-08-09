jQuery(function ($) {
    $(document).ready(function () {
        baselist= undefined;

        $('select[name="questions"]').change(function(){

            options= '';
            qid= parseInt($(this).val());
            if (!isNaN(qid)) {
                qcur= quest[qid];
                acur= qcur.answers;
                acur= acur.replace(/\n/g, '###');
                acur= acur.replace(/\r/g, '###');
                acur= acur.replace(/######/g, '###');
                aobj= acur.split('###');
                //console.log(aobj);

                for (i=0; i<aobj.length; i++) {
                    options+= '<option value="'+ i +'">'+ aobj[i] +'</option>';
                }

                itemid= $(this).parent().parent().children('.item').index($(this).parent());
                alist= $(this).parent().parent().next('.answers').children('.item').eq(itemid).find('select');
                alist.empty();
                alist.append(options);
            }
        });
        newchild= function(obj, iid) {
            $(obj).data('qid', qid);
            aid= parseInt($(obj).val());
            aname= $(obj).find('option[value="'+aid+'"]').text().trim();
            if (!isNaN(aid)) {
                childs= $(obj).parent().parent().next('.childs').children('.item').eq(iid);
                childs.append(baselist.clone(true,true));

                itchild= childs.find('.base-list').last();
                itchild.prepend('<h3>'+ aname+' -- '+aid +'</h3>');

                paid= $(obj).parent().parent().parent().data('parent');
                itchild.data('parent', paid+'x'+aid);
            }
            buildjson();
        }
        root= $('.base-list').first();
//                nodeinfo= function(obj) {
//                    tmp= obj.data('parent').split('x');
//                    return {id: parseInt(tmp[0]), length: tmp.length};
//                }
        buildjson= function(start) {
            if ((typeof start) == 'undefined') start= root;
            output= {
                q: 0,
                p: 0,
                h: 'Root Node',
                lc: '=+=root-node=-=',
                a: []
            };
            curid= $('.base-list').index(start);
            someitems= start.children('.questions').children('.item');
            for (i=0; i<someitems.length; i++) {
                output.a[i]= {
                    q: someitems.eq(i).find('select').val(),
                    p: output,
                    h: someitems.eq(i).find('option[value="'+someitems.eq(i).find('select').val()+'"]').text().trim().slice(0.15),
                    lc: '=+=question-'+someitems.eq(i).find('select').val()+'=-=',
                    a: []
                    //h: $('#Tree_name').val()
                };
                opt= start.children('.answers').children('.item').eq(i).find('option');
                for (j=0; j<opt.length; j++) {
                    output.a[i].a[j]= {
                        q: opt.eq(j).val(),
                        h: opt.eq(j).text().trim().slice(0, 15),
                        p: output,
                        lc: '=+=answer-'+opt.eq(j).val()+'=-=',
                        a: []
                    }
                }
            }

            tmp= start.attr('data-parent');
            itnode= {id: parseInt(tmp[0]), length: tmp.length};
            el= $('.base-list');
            prevnode= itnode;
            curout= output;
            previd= itnode.id;
            itemid= 0;
            for (i=curid+1; i<el.length; i++) {
                tmp2= el.eq(i).data('parent');
                tmp= el.eq(i).data('parent').split('x');
                node= {id: parseInt(tmp[tmp.length-1]), length: tmp.length};

                if (itnode.length < node.length) {
                    delta= prevnode.length - node.length;
                    if (delta == 0) {
                        curout= curout.p;
                    } else if (delta > 0) {
                        for (j=0; j<=delta; j++) {
                            curout= curout.p;
                        }
                    }

                    itemid= el.eq(i).parent().parent().children('.item').index(el.eq(i).parent());

                    console.log(delta);
                    console.log(itemid);
                    console.log(node.id);
                    console.log(curout);

                    itout= curout.a[itemid].a[node.id];
                    someitems= el.eq(i).children('.questions').children('.item');

                    for (k=0; k<someitems.length; k++) {
                        itout.a[k]= {
                            q: someitems.eq(k).find('select').val(),
                            p: itout,
                            lc: '=+=question-'+someitems.eq(k).find('select').val()+'=-=',
                            h: someitems.eq(k).find('option[value="'+someitems.eq(k).find('select').val()+'"]').text().trim().slice(0.15),
                            a: []
                            //h: $('#Tree_name').val()
                        };
                        opt= el.eq(i).children('.answers').children('.item').eq(k).find('option');
                        for (j=0; j<opt.length; j++) {
                            itout.a[k].a[j]= {
                                q: opt.eq(j).val(),
                                h: opt.eq(j).text().trim().slice(0, 15),
                                lc: '=+=answer-'+opt.eq(j).val()+'=-=',
                                p: itout,
                                a: []
                            }
                        }
                    }

                    curout= itout;
                    previd= node.id;
                    prevnode= node;
                } else break;
            }
            //console.log(output);
            outstr= JSON.stringify(output, ['q', 'a', 'h', 'lc']);
            $('#Tree_tree').val(outstr);
        }
        $('select[name="answers"]').change(function(e){

            itemid= $(this).parent().parent().children('.item').index($(this).parent());
            qid= $(this).parent().parent().prev('.questions').children('.item').eq(itemid).find('select').val();
            itemid= $(this).parent().parent().children('.item').index($(this).parent());
            if ($(this).data('qid') == 'none' || $(this).data('qid') == qid) {
                newchild($(this), itemid);
            } else {
                $("#subtree_del").dialog("open");
                subtree_del.status= undefined;
                $( "#subtree_del" ).on( "dialogclose", function( event, ui ) {
                    console.log(subtree_del);
                    if (subtree_del.status === true) {
                        childs= $(e.currentTarget).parent().parent().next('.childs').children('.item').eq(itemid);
                        childs.empty();
                        newchild($(e.currentTarget), itemid);
                    }
                } );
            }
        });

        $('.btn.btn-add').click(function(){
            item= $(this).parent().parent();
            itemid= item.parent().children('.item').index(item);
            item.after(basequest.clone(true, true));
            item.parent().next('.answers').children('.item').eq(itemid).after(baseanswer.clone(true, true));
            item.parent().parent().children('.childs').children('.item').eq(itemid).after(basechild.clone(true, true));
        });
        $('.btn.btn-del').click(function(){
            item= $(this).parent().parent();
            itemid= item.parent().children('.item').index(item);
            item.parent().next('.answers').children('.item').eq(itemid).remove();
            item.parent().next('.childs').children('.item').eq(itemid).remove();
            item.remove();
        });

        baselist= $('.base-list').clone(true, true);
        basequest= $('.base-list .questions .item').clone(true, true);
        baseanswer= $('.base-list .answers .item').clone(true, true);
        basechild= $('.base-list .childs .item').clone(true, true);

    });
});