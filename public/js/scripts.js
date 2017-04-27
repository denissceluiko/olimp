$(document).ready(function () {
    var query;
    $('#participant-search-form').submit(function (e) {
        query = $('#query_str').val();
        search(query);
        e.preventDefault();
        return false;
    });

    $(document).on('click', 'a.delete-button', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            method: 'post',
            url: '/participants/'+id,
            data: {
                '_method': 'delete',
            },
            success: function (result) {
                search(query);
            }
        });
    });

    $(document).on('click', 'button.assign-button', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            method: 'post',
            url: '/participants/assign/'+id,
            data: {

            },
            success: function (result) {
                //search(query);
                replaceStudentTable(result);
            }
        });
    });

    function replaceStudentTable(data) {
        $('#student-table').remove();
        $('.row .panel-body .panel').append(data);
    }

    function search() {
        $.ajax({
            method: 'post',
            url: '/participants/search',
            data: { query_str:  query},
            success: function (result) {
                replaceStudentTable(result);
            }
        });
    }
});

