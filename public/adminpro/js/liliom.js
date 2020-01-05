var refreshToken = function() {
    $.get('/refresh-csrf').done(function(token) {
    	$('meta[name="csrf-token"]').attr('content', token);
    	$('input[name="_token"]').val(token);
    });
}

var formatRepo = function (repo) {
	if (repo.loading) return repo;
	name = repo.name || repo.text || repo.title || repo.username;
	if (name != undefined) {
		var markup = '<li>' + name + '</li>';
		return markup;
	}
}

function formatRepoSelection(repo) {
	return repo.name || repo.text || repo.title || repo.username;
}

var replaceNthMatch = function (original, pattern, n, replace) {
    var parts, tempParts;

    if (pattern.constructor === RegExp) {
        // If there's no match, bail
        if (original.search(pattern) === -1) {
            return original;
        }

        // Every other item should be a matched capture group;
        // between will be non-matching portions of the substring
        parts = original.split(pattern);

        // If there was a capture group, index 1 will be
        // an item that matches the RegExp
        if (parts[1].search(pattern) !== 0) {
            throw {name: "ArgumentError", message: "RegExp must have a capture group"};
        }

    } else if (pattern.constructor === String) {
        parts = original.split(pattern);
        // Need every other item to be the matched string
        tempParts = [];

        for (var i=0; i < parts.length; i++) {
            tempParts.push(parts[i]);

            // Insert between, but don't tack one onto the end
            if (i < parts.length - 1) {
                tempParts.push(pattern);
            }
        }
        parts = tempParts;

    }  else {
        throw {name: "ArgumentError", message: "Must provide either a RegExp or String"};
    }

    // Parens are unnecessary, but explicit. :)
    indexOfNthMatch = (n * 2) - 1;

    if (parts[indexOfNthMatch] === undefined) {
        // There IS no Nth match
        return original;
    }

    if (typeof(replace) === "function") {
        // Call it. After this, we don't need it anymore.
        replace = replace(parts[indexOfNthMatch]);
    }

    // Update our parts array with the new value
    parts[indexOfNthMatch] = replace;

    // Put it back together and return
    return parts.join('');
}

var nl2br = function (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

$(document).ready(function () {

	refreshToken();

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#CbSelectAll").click(function() {
        $(".check-all").prop('checked', $(this).prop('checked'));
    });

    if($(".tinymce").length > 0){
        tinymce.init({
            selector: "textarea.tinymce",
            theme: "modern",
            height:300,
            directionality : "rtl",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "rtl rtl insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
            language: 'ar',
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
    }

    var oldContainer;
    $("ol.sortable").sortable({
      group: 'nested',
      afterMove: function (placeholder, container) {
        if (oldContainer != container){
            if (oldContainer)
                oldContainer.el.removeClass("active");
                container.el.addClass("active");

            oldContainer = container;
        }
      },
      onDrop: function ($item, container, _super) {
        container.el.removeClass("active");
        _super($item, container);

        // console.log(window.JSON.stringify($('#contents-lists').sortable("serialize")[0]));
        $('#sortable_content').val(window.JSON.stringify($('#contents-lists').sortable("serialize")[0]));
      }
    });

    LinkAction = $('#addLinkModal form').attr('action');
    $('#addLinkModal').on('shown.bs.modal', function (e) {
        var $btn = $(e.relatedTarget),
            $form = $('#addLinkModal form'),
            link = $btn.attr('data-link') ? JSON.parse($btn.attr('data-link')) : '';

        $form.find('input').val('');
        if ($btn.attr('data-link') !== undefined) {
            $form.attr('action', '/admin/links/'+ link.id).attr('data-do', 'update');
            $form.find('#input-method').attr('name', '_method').val('PATCH');
            $form.find('input[name="text"]').val(link.text);
            $form.find('input[name="link"]').val(link.link);
            $form.find('input[name="target"]').prop('checked', link.target);
        } else {
            $form.attr('action', LinkAction).attr('data-do', 'create');
        }
    });

    $('#addLinkModal form').submit(function(e) {
        e.preventDefault();
        var $this = $(this);

        $.ajax({
            method: $this.attr('method'),
            dataType: 'json',
            url: $this.attr('action'),
            data: $this.serialize(),
        }).done(function(response) {
            if ($this.data('do') == 'create') {
                link = '\
                <li class="dd-item item-link" data-link-id="'+ response.id +'">\
                    <div class="dd-handle highlight">'+ response.text +'</div>\
                    <div class="dd-item__btn">\
                        <a href="#!" edit-link="√">تعديل</a>\
                    </div>\
                    <ol></ol>\
                </li>';

                $('#sortable_links').append(link);

            } else if ($this.data('do') == 'update') {
                item = $('[data-link-id="'+ response.id +'"]');
                item.find('>.dd-handle').text(response.text)
                item.find('>.dd-item__btn>[data-link]').attr('data-link', window.JSON.stringify(response));
            }

            $('#addLinkModal').modal('toggle');
        });
    });

    // File uplode
    $('.filer_input').filer({
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="zmdi zmdi-cloud-upload"></i></div><div class="jFiler-input-text"><h3>اضغط هنا لتحديد الصور</h3> <span style="display:inline-block; margin: 15px 0">او</span></div><a class="jFiler-input-choose-btn blue">تصفح الملفات</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        extensions: ['png', 'jpg', 'jpeg'],
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="zmdi zmdi-delete jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="zmdi zmdi-delete jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        files: (typeof jFilerFiles === 'undefined') ? [] : jFilerFiles,
        // dragDrop: {
        //     dragEnter: null,
        //     dragLeave: null,
        //     drop: null,
        // },
        addMore: true,
        captions: {
            removeConfirmation: 'هل أنت متأكد أنك تريد إزالة هذا الملف؟',
            errors: {
                filesType: 'يجب عليك رفع صورة'
            }
        },
        onRemove: function(e) {
            file      = $(e),
            fileIndex = file.data('jfiler-index'),
            fileName  = file.find('.jFiler-item-title > b').attr('title'),
            filesContainer = file.parents('.files-container'),
            inputName = filesContainer.data('name');

            filesContainer.find('input[name="'+ inputName +'['+ fileIndex +']"][value="'+ fileName +'"]').remove();
        },
    });

	var lastResults = [];
	$('.select2').select2({
		dir: 'rtl',
		maximumSelectionLength: $('.select2').data('max') ? $('.select2').data('max') : null,
		ajax: {
			dataType: 'json',
			delay: 250,
			method: 'POST',
			data: function (params) {
				return {
					q : params.term,
				};
			},
			processResults: function (data) {
				lastResults = data;
		  		return {
		    		results: data
		  		};
			},
			cache: true
		},
		createTag: function(params) {
			term = $.trim(params.term);

		    if (term === '') return null;

			if(! lastResults.some(function(r) { return r.title == term })) {
	        	return {
			    	id: term,
			    	text: term + ' (جديد)'
			    };
	        }
		},
		escapeMarkup: function (markup) { return markup; },
		minimumInputLength: 2,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection,
	});

    $('.clone-wrapper').cloneya({
        maximum: 1000,
        serializeIndex: true,
        cloneButton  : '.col-sm-12 > .clone',
        deleteButton : '.col-sm-12 > .delete',
        serializeID  : true,
    }).on('clone_after_append', function(event, toclone, newclone) {
        // select = newclone.find('.bootstrap-select select').clone();
        // newclone.find('.bootstrap-select').remove();
        // newclone.find('.ap-selectpicker').append(select);
        // newclone.find('.selectpicker').selectpicker({
        //     noneResultsText: 'لا يوجد نتائج {0}',
        //     style: 'btn'
        // });
    });

    $('#req_res').change(function() {
        var selected = $('#req_res option:selected').val(),
            $form = $('#response_mess');
        if (selected == '1') {
            $form.fadeIn();

            if ($form.data('type') == 1) {
                title = 'تم الموافقة على طلب السحب';
                body = "تمت الموافقة على طلب السحب الخاص بك،\nتم ارسال الارباح الى حسابك في باي بال\nنتمنى لك التوفيق";
            } else if ($form.data('type') == 2) {
                title = 'تم الموافقة على طلب الرفع';
                body = "لقد تمت الموافقة على طلب الرفع،\nنتمنى كل التوفيق في المبيعات";
            } else if ($form.data('type') == 3) {
                title = 'تم الموافقة على العمل #'+ $form.data('item-id');
                body = "تم الموافقة على عملك الابداعي،\nنتمنى كل التوفيق في المبيعات";
            }

            $form.find('#mess_title').val(title);
            $form.find('#mess_body').val(body);

        } else if (selected == '0') {
            $form.fadeIn();

            if ($form.data('type') == 1) {
                title = 'تم رفض طلب السحب';
                body = "تم رفض طلب السحب الخاص بك،\nالسبب:\n[السبب]";
            } else if ($form.data('type') == 2) {
                title = 'تم رفض طلب رفع الاعمال';
                body = "تم رفض الطلب الخاص بك لرفع الاعمال،\nالسبب:\n[السبب]";
            } else if ($form.data('type') == 3) {
                title = 'تم رفض العمل #'+ $form.data('item-id');
                body = "تم رفض العمل الخاص بك،\nالسبب:\n[السبب]";
            }

            $form.find('#mess_title').val(title);
            $form.find('#mess_body').val(body);

        } else {
            $form.fadeOut();

            $form.find('#mess_title').val('');
            $form.find('#mess_body').val('');
        }
    });
});