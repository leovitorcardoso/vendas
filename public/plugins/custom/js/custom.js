$(function() {
    $('body').on('click', 'a[data-action="delete"]', function () {

        var form = false;
        var urlLocation = false;

        if ($(this).data('form') && $(this).data('type') == 'submit') {
            form = $($(this).data('form'));
        } else {
            urlLocation = $(this).data('href');
        }

        var title = $(this).data('title') ? $(this).data('title') : "Você tem certeza?";
        var text  = $(this).data('text')  ? $(this).data('text')  : "Você realmente deseja remover esta informação?";
        var icon  = $(this).data('icon')  ? $(this).data('icon')  : "warning";

        swal({
            title: title,
            text: text,
            icon: icon,
            dangerMode: true,
            buttons: {
                confirm: {
                    text: "Sim",
                    value: true,
                    closeModal: true
                },
                cancel: {
                    text: "Não",
                    visible: true,
                    value: false,
                    closeModal: true,
                },
            }
        }).then(function(willDelete) {
            if (willDelete) {
                if (form) {
                    form.trigger('submit');
                } else {
                    window.location = urlLocation;
                }
            }
        });
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="touch-spin"]').each(function () {
        $(this).TouchSpin({
            min: $(this).attr('min') ? $(this).attr('min') : 1,
            max: $(this).attr('max') ? $(this).attr('max') : 9999999,
            stepinterval: 50,
            maxboostedstep: 10000000
        });
    });

    $('[data-toggle="data-table"]').DataTable({
        order: [[1, "asc"]],
        ordering: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json'
        },
    });
});