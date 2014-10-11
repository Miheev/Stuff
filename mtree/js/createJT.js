var nid= 0;

jQuery(function ($) {
    $(document).ready(function () {

//        treestr= treestr.replace(/"lc"/g, '"li_attr"');
//        treestr= treestr.replace(/"=\+=/g, '{"data-nodeid":"');
//        treestr= treestr.replace(/=-="/g, '"}');

        treejs= {
            q: 0,
            text: "Tree name",
            li_attr: {class: 'root answer'},
            children: []
        };

        addtolist= function(qid) {
          quest[qid] = {
              id: qid,
              question: $('#TreeData_question').val(),
              answers: $('#TreeData_answers').val()
          };
            $('#questions').append('<option value="'+qid+'">'+$('#TreeData_question').val()+'</option>');
            $('#questions').val(qid);
        };
        updatelist= function(qid) {
            quest[qid] = {
                id: qid,
                question: $('#TreeData_question').val(),
                answers: $('#TreeData_answers').val()
            };
            $('#questions option[value="'+qid+'"]').text($('#TreeData_question').val());
            $('#questions').val(qid);

            updatetree(qid);
        };
        updatetree= function(qid){
            tobj=$('#jstree_out').jstree(true).get_json('j1_1');
            outstr= JSON.stringify(tobj, ['id', 'li_attr', 'text', 'children', 'state']);

        };
        getanswers= function(qid) {
                options= [];
                qcur= quest[qid];
                acur= qcur.answers;
                acur= acur.replace(/\n/g, '###');
                acur= acur.replace(/\r/g, '###');
                acur= acur.replace(/######/g, '###');
                aobj= acur.split('###');
                //console.log(aobj);

                for (i=0; i<aobj.length; i++) {
                    atext= aobj[i].substr(0,15);
                    options[i]={
                        q: i,
                        text: atext,
                        li_attr: {"data-nodeid": i, class:'answer'},
                        children: []
                    };
                }
            return options;
        };
        savetree= function(node){
            if (!node) node= 'j1_1';
            tobj=$('#jstree_out').jstree(true).get_json(node);
            outstr= JSON.stringify(tobj, ['id', 'li_attr', 'text', 'children']);
            $('#Tree_tree').val(outstr);
        };

        $('#jstree_out').jstree({
            'core': {
                'data':treejs,
                'check_callback':true
            }
        });
        $('#jstree_out').on('loaded.jstree', function(){
            treeobj= $(this);

//            $(this).jstree(true).open_node(nodeway);
            $(this).jstree(true).select_node('j1_1');

            $('#Tree_name').change(function(){
                treeobj.jstree(true).rename_node('j1_1',
                    ($(this).val().length)? $(this).val() : 'Tree name'
                );
            });

            $('.btn.tree-btn-add').click(function(){
                nid= $('.jstree-node > a.jstree-clicked').parent().attr('id');

                if ($('#'+nid).hasClass('answer')) {
                    qid= $('#questions').val();
                    qtext= $('#questions option[value="'+qid+'"]').text().trim().substr(0,15);

                    aobj= getanswers(qid);
                    ndata= {
                        q: qid,
                        text: qtext,
                        li_attr: {"data-nodeid": qid, class:'question'},
                        children: aobj
                    };
                    treeobj.jstree(true).create_node(nid, ndata, 'last',function(){
                        if (!$('#'+nid).hasClass('jstree-open'))
                            $(treeobj).jstree(true).open_node(nid);
                    });
                    savetree();
                } else
                    alert('It`s not an answer node!\n\rOnly question to answer addition alowed!');
            });
            $('.btn.tree-btn-del').click(function(){
                nid= $('.jstree-node > a.jstree-clicked').parent().attr('id');

                $("#subtree_del").dialog("open");
                subtree_del.status= undefined;
            });
            $( "#subtree_del" ).on( "dialogclose", function( event, ui ) {
                console.log(subtree_del);
                if (subtree_del.status === true) {
                    if ($('#'+nid).length) {
                        if ($('#'+nid).hasClass('question')) {
                            treeobj.jstree(true).delete_node(nid);
                        } else {
                            alert('It`s not a question node!\n\rOnly question deletetion alowed!');
                        }
                    }
                }
            } );
            $('.btn.tree-btn-edit').click(function(){
                node= $('.jstree-node > a.jstree-clicked').parent();
                if (node.hasClass('answer'))
                    q_id= node.parent().parent().data('nodeid');
                else
                    q_id= node.data('nodeid');

                $('#tree-data-form .buttons').before('<div class="row">'+
                        '<input type="hidden" value="update" name="TreeData[update_node]" />'+
                        '<input type="hidden" value="'+q_id+'" name="TreeData[qid]" />'+
                    '</div>');
                $.ajax(aurl,{
                    dataType: 'json',
                    type: 'POST',
                    data: {TreeData:{
                                  update_node:'get_data',
                                  qid:q_id
                    }},
                    beforeSend: function() {
                        $("#AjaxLoader").show();
                    },
                    complete: function(data, status){
                        $("#AjaxLoader").hide();

                        if(status=="success"){
                            qdata= $.parseJSON(data.responseText);
                            if (!qdata) console.log(data.responseText);

                            $('#TreeData_question').val(qdata.question);
                            $('#TreeData_answers').val(qdata.answers);
                        } else{
                            console.log('Ajax request failed:: on edit question');
//                            $.each(data, function(key, val) {
//                                $("#tree-data-form #"+key).text(val);
//                            });
                        }
                    }
                });
            });

        });
        $('#jstree_out').on('activate_node.jstree', function(e, node){
        });

    });
});