/**
 * Created by lucius on 23.08.16.
 */

(function($){
    $(function(e) {
        function add_remove_on_click_handler(){
            $('button.btn.bacluc-inlineform.actionbutton.delete').off("click");
            $('button.btn.bacluc-inlineform.actionbutton.delete').click(function(e){
                $(this)
                //div.subentityrowedit.row
                    .parent()
                    //div.col-xs-12 (foreach entity row)
                    .parent().remove();
            });
        }


        $('button.btn.bacluc-inlineform.actionbutton.add').click(function(e) {
            var hiddenrow = $(this).parent().find('div.hidden_form_row');
            var hiddenrowcopy = $($(this).parent().find('div.hidden_form_row').html());
            var parentpostname = $(hiddenrow).find('div.parent_postname').text();
            var parentidname = $(hiddenrow).find('div.parent_idname').text();
            var replace_brace_in_id_with = $(hiddenrow).find('div.replace_brace_in_id_with').text();
            var rownum = $(hiddenrow).find('div.rownum').text();
            var prepend_before_realname = $(hiddenrow).find('div.prepended_before_realname').text();
            var options_url = $(hiddenrow).find('div.options_url').text();
            var options_template = $(hiddenrow).find('div.options_template').html();
            rownum = parseInt(rownum);

            //update the old rownum
            $(hiddenrow).find('div.rownum').text(rownum + 1);
            /**
             *
             * @param parentpostname
             * @param rownum
             * @param prependet_before_realname
             * @param currentpostname
             * @returns {string}
             */
            function renameAttribute(parentpostname, rownum, prependet_before_realname, currentpostname, replace_brace_in_id_with) {

                var newprepend = parentpostname + replace_brace_in_id_with + rownum + replace_brace_in_id_with+replace_brace_in_id_with;


                var postname = currentpostname.substr(prependet_before_realname.length);

                if(replace_brace_in_id_with !== undefined){
                    replace_brace_in_id_with = replace_brace_in_id_with.replace(new RegExp("(\[|\])", "g"), replace_brace_in_id_with);
                }

                return newprepend + postname + replace_brace_in_id_with;
            }

            //now rename id and name of new row
            $(hiddenrowcopy).find('*').each(function (e) {


                if ($(this).is('[id]')) {
                    $(this).attr('id', renameAttribute(parentpostname, rownum, prepend_before_realname, $(this).attr('id'), replace_brace_in_id_with));
                }
                if ($(this).is('label[for]')) {
                    $(this).attr('for', renameAttribute(parentpostname, rownum, prepend_before_realname, $(this).attr('for')));
                }
                if (($(this).is('input[name]') || $(this).is('textarea[name]') || $(this).is('select[name]') )&& true) {
                    $(this).attr('name', renameAttribute(parentpostname, rownum, prepend_before_realname, $(this).attr('name')));
                    if(window.parsley) {
                        $(this).on('change, keyup', function (e) {
                            $(this).parsley().validate();
                        });
                    }
                    if($(this).is('input[name]') || $(this).is('textarea[name]') ) {
                        var values = new Bloodhound({
                            datumTokenizer: Bloodhound.tokenizers.whitespace,
                            queryTokenizer: Bloodhound.tokenizers.whitespace,
                            prefetch: options_url
                        });
                        values.initialize();
                        //eval("templatefunction = "+options_template+";");
                        $(this).typeahead({

                                minLength: 0,
                                highlight: true,
                                limit: 10000,
                            }, {
                                name: renameAttribute(parentpostname, rownum, prepend_before_realname, $(this).attr('name'), ""),
                                source: function (q, sync) {
                                    if (q === '' || q === '*') {
                                        sync(values.index.all());
                                    }

                                    else {
                                        values.search(q, sync);
                                    }
                                },
                                //display:'postemail',
                                limit: 10000,
                                templates:{
                                    suggestion: function(data){
                                        var localtemplate = options_template;
                                        for(var i in data){
                                            localtemplate = localtemplate.replace(new RegExp("\{\{+"+i+"\}\}", "g"), data[i]);
                                        }
                                      return localtemplate;
                                    },
                                },

                            }
                        );
                    }
                }



            });
            $(hiddenrow).parent().find('div.bacluc-realrows ').append(hiddenrowcopy);
            add_remove_on_click_handler();
        });

        add_remove_on_click_handler();





    });
})(jQuery)
