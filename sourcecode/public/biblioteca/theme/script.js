(function ($) {
    'use strict';

    $(function () {
        $('#lateral-menu-btn').on('click', function () {
            $('#sidebar').toggleClass('expand');
        });

        loadDataTables();
        loadMultiSelect();
    });


    // Hides sidebar's footer when it's closed
    $(document).ready(function () {
        let $sidebar = $('#sidebar');
        $('#lateral-menu-btn').on('click', function () {
            $sidebar.toggleClass('expanded');

            if ($sidebar.hasClass('expanded')) {
                $('.sidebar-footer').hide();
            } else {
                $('.sidebar-footer').show();
            }
        });
    });

    function loadMultiSelect() {
        $.each($('.multi-select'), function(e, element) {
            $(element).bsMultiSelect();
        });
    }

    function loadDataTables() {
        const localeFile = '/biblioteca/datatables@2.1.7/i18n/pt.json';
        let $tables = $('table.data-tables');
        $.each($tables, function (t, table) {
            let $table = $(table);

            var tableOptions = {
                'responsive': true,
                'oLanguage': {
                    'sUrl': localeFile,
                    'sSearch': '<span class="input-group-addon"><i class="fas fa-search"></i></span>'
                },
                'autoWidth': true,
            };

            /**
             * Use data-dt-order="[[index, order]]" to sort the table.
             * Where:
             *
             *      index = column number (starting by 0)
             *      order = 'asc' or 'desc'
             *
             * For multiple ordering, use:
             *
             *      data-dt-order="[[index, order], [index, order] ... ]"
             */
            var _order = $table.data('dt-order');
            if (_order) {
                _order = JSON.parse(_order.replace(/'/gi, '"'));
                tableOptions['order'] = _order;
            }

            $table.DataTable(tableOptions);
        });
    }

})(jQuery);