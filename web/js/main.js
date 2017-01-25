function permanentTab() {
    //save the latest tab (http://stackoverflow.com/a/18845441)
    $('a[data-toggle="tab"]').on('click', function (e) {
       localStorage.setItem('lastTab', $(e.target).attr('href'));
    });

    //go to the latest tab, if it exists:	create directory baru js then copy
    var lastTab = localStorage.getItem('lastTab');

    if (lastTab) {
       $('a[href="' + lastTab + '"]').click();
    }
}
