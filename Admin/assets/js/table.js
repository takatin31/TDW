(function () {
    var dropdownMenu;
    $(window).on('show.bs.dropdown', function (e) {
        dropdownMenu = $(e.target).find('.dropdown-menu');
        $('body').append(dropdownMenu.detach());
        var eOffset = $(e.target).offset();
        dropdownMenu.css({
            'display': 'block',
            'top': eOffset.top + $(e.target).outerHeight(),
            'left': eOffset.left
        });
    });
    $(window).on('hide.bs.dropdown', function (e) {
        $(e.target).append(dropdownMenu.detach());
        dropdownMenu.hide();
    });
})();

function dataFormater(value, row, index) {
    var id = row.id;
    var strHTML = "<div class='btn-group' astyle='position: absolute'><button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown'>Options<span class='caret'></span></button><ul class='dropdown-menu text-left' role='menu' style='position:absolute'>";
        strHTML += "<li><a href='/Edit/" + id + "'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Edit</a></li>";
        strHTML += "<li><a href='/Delete/" + id + "'><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;Remove</a></li>";
        strHTML += "</ul></div>";

    var valReturn = strHTML;
    return valReturn;
}