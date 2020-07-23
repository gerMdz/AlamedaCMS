Dropzone.autoDiscover = false;

$(document).ready(function () {
    var referenceList = new ReferenceList($('.js-reference-list'))
    initializeDropzone(referenceList);

    var $locationSelect = $('.js-article-form-location');
    var $specificLocationTarget = $('.js-specific-location-target');

    $locationSelect.on('change', function (e) {
        $.ajax({
            url: $locationSelect.data('specific-location-url'),
            data: {
                location: $locationSelect.val()
            },
            success: function (html) {
                if (!html) {
                    $specificLocationTarget.find('select').remove();
                    $specificLocationTarget.addClass('d-none');

                    return;
                }

                // Replace the current field and show
                $specificLocationTarget
                    .html(html)
                    .removeClass('d-none')
            }
        });
    });
});

// todo - use Webpack Encore so ES6 syntax is transpiled to ES5
class ReferenceList {
    constructor($element) {
        this.$element = $element;
        this.sortable = Sortable.create(this.$element[0],
            {
                handle: '.drag-handle',
                animation: 150,
                onEnd: () => {
                    console.log(this.sortable.toArray());
                    $.ajax(
                        {
                            url: this.$element.data('url')+'/reorder',
                            method: 'POST',
                            data: JSON.stringify(this.sortable.toArray())
                        }
                    )
                }
            }
            );
        this.references = [];
        this.render();
        this.$element.on('click', '.js-reference-delete', (event) => {
            this.handleReferenceDelete(event);
        });
        this.$element.on('blur', '.js-edit-filename', (event) => {
            this.handleReferenceEditFilename(event);
        });
        $.ajax({
            url: this.$element.data('url')
        }).then(data => {
            this.references = data;
            this.render();
            console.log(this.references)

        })
    }

    addReference(reference) {
        this.references.push(reference);
        this.render();
    }

    handleReferenceDelete(event) {
        const $li = $(event.currentTarget).closest('.list-group-item');
        const id = $li.data('id');
        $li.addClass('disabled');

        $.ajax({
            url: '/admin/entrada/references/' + id,
            method: 'DELETE'
        }).then(() => {
                this.references = this.references.filter(reference => {
                    return reference.id !== id;
                });
                this.render();
            }
        )
    }

    handleReferenceEditFilename(event){
        const $li = $(event.currentTarget).closest('.list-group-item');
        const id = $li.data('id');
        const reference = this.references.find(reference => {
            return reference.id === id;
        });
        reference.originalFilename = $(event.currentTarget).val();
        var origin = reference.originalFilename;
        $.ajax({
            url: '/admin/entrada/references/'+id,
            method: 'PUT',
            data: JSON.stringify(reference)
        }).catch(data=>{

            var msg =  JSON.parse(data.responseText).violations[0].title;
            alert(msg);

        })
        ;
    }

    render() {
        const itemsHtml = this.references.map(reference => {
            return `
        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${reference.id}">
            <span class="drag-handle fas fa-bars ml-0 mr-1"></span>
            <input type="text" value="${reference.originalFilename}" class="form-control js-edit-filename" style="width: auto;">
            <span class="p-0">
                <a href="/admin/entrada/referencias/${reference.id}/download" class=" btn-link btn-sm "><span class="fa fa-download" style="vertical-align: middle"></span></a>
                <a class="js-reference-delete btn-link btn-sm"><span class="fa fa-trash"></span></a>
            </span>
        </li>
`
        });
        this.$element.html(itemsHtml.join(''));
    }
}

/**
 *
 * @param {ReferenceList} referenceList
 */
function initializeDropzone(referenceList) {
    var formElement = document.querySelector('.js-reference-dropzone');
    if (!formElement) {
        return;
    }

    var dropzone = new Dropzone(formElement, {
        dictDefaultMessage: "Para cargar un archivo, haz clic para buscarlo o simplemente muevelo hasta el recuadro",
        paramName: 'reference',
        html: true,
        init: function () {
            this.on('success', function (file, data) {
                referenceList.addReference(data);
            });
            this.on('error', function (file, data) {
                if (data.detail) {

                    this.emit('error', file, data.detail);

                }
            })

        }
    });
}
